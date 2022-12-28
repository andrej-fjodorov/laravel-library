<?php

namespace App\Console\Commands;

use App\Models\Article;
use App\Models\Article_Author;
use App\Models\Author;
use App\Models\Book;
use App\Models\Books;
use App\Models\Books_Author;
use App\Models\Files;
use App\Models\Infoarticle;
use App\Models\Inforelease;
use App\Models\Issue;
use App\Models\Journal;
use App\Models\Rubric;
use App\Models\Statrelease;
use App\Models\Statreleaserubric;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class Migratedatabase extends Command
{

    private function getAuthor($author_surname,$author_name,$author_middlename)
    {                                                                         
        return Author::where(['surname'=> $author_surname,
            'name'=> $author_name,
            'middlename'=> $author_middlename])
            ->first()->id;
    }
     
    private function getFile($filepath, $filename)
    {
        $file = Files::where(['filepath' => $filepath, 'filename'=>$filename])->first();
        return $file ? $file->id : null;
    }

    private function loadRubrics() 
    {
        $old_rubrics = DB::select("SELECT name, short FROM  library.refbooks  WHERE ref = 701");
        foreach ($old_rubrics as $old_rubric) {
            $new_rubric = new Rubric;
            $new_rubric->title = $old_rubric->name;
            $new_rubric->shottitle = $old_rubric->short;
            $new_rubric->save();
            $new_rubric->refresh();            
        }
    }

    private function loadAuthor() {
        $old_authors = DB::SELECT ("SELECT DISTINCT sname, NAME, fname FROM library.libedauth l, library.persons p
                WHERE p.ID = l.AUTHOR 
                ORDER BY sname");
                foreach ($old_authors as $old_author) {
                    $new_author  = new Author;                    
                    $new_author->surname = $old_author->sname; 
                    $new_author->name = $old_author->NAME;                 
                    $new_author->middlename = $old_author->fname;                                                     
                    $new_author->save();
                    $new_author->refresh();             
                            
        }  

    }

    private function loadJournal() {
        $old_journals = DB::select("SELECT lm.id, lm.NAME,lm.ISSN,r.id as rubric FROM library.libmags lm left join library.refbooks lr   ON  lr.ID = lm.RUBRIC  left JOIN  rubric r ON  r.shottitle = lr.SHORT WHERE   lr.REF = 701 OR lm.RUBRIC = 0 ");
        foreach ($old_journals as $old_journal) {
            $new_journal = new Journal;
            $new_journal->name = $old_journal->NAME;
            $new_journal->ISSN = $old_journal->ISSN;
            $new_journal->rubric_id = $old_journal->rubric;              
            $new_journal->save();
            $new_journal->refresh();            
            $old_issues = DB::select("
                SELECT li.id, li.code,li.ISDYEAR,li.NUMBER,li.DATEIN
                FROM  library.libissues li
                WHERE li.mag = ?"
            ,[$old_journal->id]);
            foreach ($old_issues as $old_issue) {
                $new_issue = new Issue;
                $new_issue->journal_id = $new_journal->id;
                $new_issue->issuecode = $old_issue->code;
                $new_issue->issueyear = $old_issue->ISDYEAR;
                $new_issue->issuenumber = $old_issue->NUMBER;
                $new_issue->issuedate = $old_issue->DATEIN;
                $new_issue->save();
                $new_issue->refresh();               

                $old_articles = DB::select("SELECT la.ID, la.NAME, la.PAGE, la.ANNOT,la.file, la.file_name FROM 
                 library.libarticles la
                 WHERE  la.ISSUE = ?"
                ,[$old_issue->id]);
                foreach ($old_articles as $old_article) {
                    $new_article = new Article;
                    $new_article->issue_id= $new_issue->id;  
                    $new_article->name = $old_article->NAME;
                    $new_article->pages = $old_article->PAGE;
                    $new_article->annotation = $old_article->ANNOT;
                    print($old_article->file.' '.$old_article->file_name.'\n');
                    $new_article->file_id = $this->getFile($old_article->file, $old_article->file_name);                             
                    $new_article->save();
                    $new_article->refresh();                    
                    $authors = DB::select(
                        "SELECT p.SNAME, p.NAME, p.FNAME 
                        FROM library.libarticles la, library.libedauth l , library.persons p
                        WHERE  p.ID  = l.AUTHOR AND la.ID = l.EDITION AND la.ID = ?
                        AND l.EDKIND = 10000288",
                        [$old_article->ID]
                    );
                    foreach ($authors as $author) {
                        $new_author_article = new Article_Author;
                        $new_author_article->article_id = $new_article->id;
                        $new_author_article->author_id = $this->getAuthor(
                        $author->SNAME, $author->NAME, $author->FNAME);
                        $new_author_article->save();
                        $new_author_article->refresh();
                    }                 
                    
                }   

            }
        } 
    }

    private function loadBooks() {
        $old_books = DB::select("SELECT 
        lb.ID,
        lb.NAME,
        lb.NAMEADD,
        lb.RESPONS,
        lb.RESPONS1,
        lb.SOMEINFO,
        lb.ISDPLACE,
        lb.ISDNAME,
        YEAR(lb.ISDDATE) as YEARDATE,
        lb.tom,
        lb.PAGES,
        lb.AUTHSIGN,
        lb.CODE,
        lb.NomerSK,
        lb.DATEIN,
        lb.COST,
        lb.ISBN,
        lb.ANNOT,
        lb.withdraw,
        lb.file,
        lb.file_name,
        r.id as rubric
        FROM
        library.libbooks lb, library.refbooks lr, rubric r
        WHERE 
        lb.RUBRIC = lr.ID AND lr.REF = 701
        AND lr.SHORT = r.shottitle");  
        foreach ($old_books as $old_book) {
            $new_book = new Book;
            $new_book->name = $old_book->NAME;
            $new_book->additionalname = $old_book->NAMEADD;
            $new_book->response = $old_book->RESPONS;
            $new_book->additionalresponse = $old_book->RESPONS1;
            $new_book->bookinfo = $old_book->SOMEINFO;
            $new_book->publishplace = $old_book->ISDPLACE;
            $new_book->publishhouse = $old_book->ISDNAME;
            $new_book->publishyear = $old_book->YEARDATE;
            $new_book->tom = $old_book->tom;
            $new_book->pages = $old_book->PAGES;
            $new_book->authorsign = $old_book->AUTHSIGN;
            $new_book->code = $old_book->CODE;
            $new_book->numbersk = $old_book->NomerSK;
            $new_book->recieptdate = $old_book->DATEIN;
            $new_book->cost = $old_book->COST;
            $new_book->ISBN = $old_book->ISBN;
            $new_book->annotation = $old_book->ANNOT;
            $new_book->withraw = $old_book->withdraw;
            $new_book->rubric_id = $old_book->rubric;           
            $new_book->file_id = $this->getFile($old_book->file, $old_book->file_name);
            $new_book->save();
            $new_book->refresh(); 
                $books = DB::select(
                    "SELECT b.ID, b.NAME, p.SNAME, p.NAME,p.FNAME FROM library.libedauth l,library.libbooks b, library.persons p
                    WHERE l.edition = b.ID AND l.edkind = 10000287 AND l.author = p.ID
                    AND b.ID = ?",
                    [$old_book->ID]
                );
                foreach ($books as $book) {
                    $new_book_author = new Books_Author();
                    $new_book_author->book_id = $new_book->id;
                    $new_book_author->author_id = $this->getAuthor(
                        $book->SNAME, $book->NAME, $book->FNAME);
                    $new_book_author->save();
                    $new_book_author->refresh();
                }                                
        } 
    }

    private function loadStatreleaserubric() {
        $old_statreleaserubrics = DB::select("INSERT INTO statreleaserubric(title)
        SELECT name FROM library.refbooks lr
        WHERE lr.REF = 703"); 
        $new_statreleaserubric  = new Statreleaserubric;
        foreach ($old_statreleaserubrics as $old_statreleaserubric) {
            $new_statreleaserubric->title = $old_statreleaserubric->name; 
            $new_statreleaserubric->save();
            $new_statreleaserubric->refresh();            
        }
    }

    private function LoadStatreleases() {
        $old_statreleases = DB::select("SELECT 
        ls.NAME,
        ls.NAMEADD,
        ls.RESPONS,
        ls.ISDPLACE,
        YEAR(ls.ISDDATE) as YEARDATE,
        ls.PAGES,
        ls.DATEIN,
        ls.COST,
        ls.CODE,
        ls.AUTHSIGN,
        ls.NUMSK,
        r.id as RUBRIC
        FROM library.libstats ls, library.refbooks lr, statreleaserubric r
        WHERE ls.RUBRIC = lr.ID 
        AND lr.NAME = r.title
        AND lr.REF = 703");
        
        foreach ($old_statreleases as $old_statrelease) {
            $new_statrelease  = new Statrelease;
            $new_statrelease->name = $old_statrelease->NAME; 
            $new_statrelease->additionalname = $old_statrelease->NAMEADD; 
            $new_statrelease->response = $old_statrelease->RESPONS;  
            $new_statrelease->publishplace = $old_statrelease->ISDPLACE; 
            $new_statrelease->publishyear = $old_statrelease->YEARDATE; 
            $new_statrelease->pages = $old_statrelease->PAGES; 
            $new_statrelease->recieptdate = $old_statrelease->DATEIN; 
            $new_statrelease->cost = $old_statrelease->COST; 
            $new_statrelease->code = $old_statrelease->CODE;
            $new_statrelease->authorsign = $old_statrelease->AUTHSIGN; 
            $new_statrelease->numbersk = $old_statrelease->NUMSK; 
            $new_statrelease->rubric_id = $old_statrelease->RUBRIC;            
            $new_statrelease->save();   
            
        }  
    }

    private function loadInforeleases() {
        $old_inforeleases = DB::select("SELECT 
        li.NAME,
        lf.ID as id,
        lf.NUMBER,
        lf.NUMSK,
        lf.ISDYEAR,
        lf.LINK       
        FROM 
        library.libinfos li
        left JOIN library.libinfiss lf ON li.ID = lf.INFORM         
        WHERE li.ID = 1");               
        foreach ($old_inforeleases as $old_inforelease) {
            $new_inforelease  = new Inforelease;
            $new_inforelease->name = $old_inforelease->NAME; 
            $new_inforelease->number = $old_inforelease->NUMBER; 
            $new_inforelease->numbersk = $old_inforelease->NUMSK;  
            $new_inforelease->publishyear = $old_inforelease->ISDYEAR;                          
            $new_inforelease->save(); 
            $new_inforelease->refresh();  
           
            
            $old_infoarticles =  DB::select("SELECT                     
            la.ISSUE,
            la.NAME,            
            la.SOURCE,                        
            la.ISDDATE,
            la.ADDINFO
            FROM            
            library.libinfart AS la
            WHERE la.ISSUE = ?",[$old_inforelease->id]);  
            foreach ($old_infoarticles as $old_infoarticle) {
                $new_infoarticle  = new Infoarticle;
                $new_infoarticle->inforelease_id = $new_inforelease->id; 
                $new_infoarticle->name = $old_infoarticle->NAME; 
                $new_infoarticle->source = $old_infoarticle->SOURCE;                 
                $new_infoarticle->recieptdate = $old_infoarticle->ISDDATE;
                $new_infoarticle->additionalinfo = $old_infoarticle->ADDINFO; 
                $new_infoarticle->file_id = $this->getFile($old_inforelease->LINK,null);                       
                $new_infoarticle->save();
                $new_infoarticle->refresh();                 
                    
            }            
            
        }         
       
    }

    private function loadFile(){
        $files = DB::select("SELECT la.file, la.file_name FROM library.libarticles la
                    WHERE la.FILE <> ''
                    ORDER BY la.FILE desc");
                    foreach ($files as $file) {
                        $new_file = new Files;
                        $new_file->filepath = $file->file;
                        $new_file->filename = $file->file_name;
                        $new_file->save();
                        $new_file->refresh();
                    }
                } 
    private function loadinfoarticlefile(){
        $files = DB::select("SELECT li.LINK FROM library.libinfiss li
                        WHERE li.LINK <> ''
                        ORDER BY li.LINK desc");
                        foreach ($files as $file) {
                                $new_file = new Files;
                                $new_file->filepath = $file->LINK;
                                $new_file->filename = null;
                                $new_file->save();
                                $new_file->refresh();
                    }
                } 

    private function loadBookfile(){
        $files = DB::select("SELECT b.file, b.file_name FROM library.libbooks b
                        WHERE b.FILE <> ''
                        ORDER BY b.FILE desc");
                        foreach ($files as $file) {
                                $new_file = new Files;
                                $new_file->filepath = $file->file;
                                $new_file->filename = $file->file_name;
                                $new_file->save();
                                $new_file->refresh();
                    }
                } 

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migratedatabase';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Simple database replication';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    

    public function handle() {

        $this->loadRubrics();
        $this->info('Загрузка рубрик успешно завершена');
        $this->loadAuthor();
        $this->info('Загрузка авторов успешно завершена');
        /*$this->loadFile();
        $this->info('Загрузка файлов статей успешно завершена');*/
        $this->loadBookfile();
        $this->info('Загрузка файлов книг успешно завершена');       
        $this->loadinfoarticlefile();
        /*$this->info('Загрузка файлов  статей информационных выпусков успешно завершена');
        $this->loadInforeleases(); 
        $this->info('Загрузка информационных выпусков успешно завершена');*/  
        $this->loadStatreleaserubric();
        $this->info('Загрузка статистических рубрик успешно завершена');
        $this->LoadStatreleases();
        $this->info('Загрузка  статистических сборников успешно завершена');
        $this->loadBooks();
        $this->info('Загрузка книг успешно завершена');
        /*$this->loadJournal();  
        $this->info('Загрузка журналов успешно завершена');*/  
        /*$get = Storage::disk('public')->exists('Files/inform/1-2000-06.doc');        
        echo($get);*/   
        
        
    }


    public function old_handle()    
    {   DB::Select("INSERT into rubric(title,shottitle)  select  name, short from  library.refbooks  where ref = 701");
        $this->info('Миграция таблицы рубрики успешно завершена');
        DB::Select("INSERT into journal(name,issn,rubric_id)SELECT lm.NAME,lm.ISSN,r.id FROM library.libmags lm left join library.refbooks lr   ON  lr.ID = lm.RUBRIC  left JOIN  rubric r ON  r.shottitle = lr.SHORT WHERE   lr.REF = 701 OR lm.RUBRIC = 0 ");
        $this->info('Миграция таблицы журналы успешно завершена');
        // DB::Select("INSERT into article(name,pages,annotation,issue_id)  select name, page,annot,issue  from  library.libarticles");
        DB::update("UPDATE library.libissues SET datein=NULL where datein='0000-00-00'");
        DB::Select("INSERT into issue (issuecode,issueyear,issuenumber,issuedate) SELECT li.code,li.ISDYEAR,li.NUMBER,li.DATEIN
        FROM  library.libissues li
        JOIN library.libmags lm  ON lm.ID = li.mag");
        $this->info('Миграция таблицы выпуски журналов успешно завершена');
        DB::update("UPDATE issue 
        SET issue.journal_id  =  (select new_journal.id
        FROM  library.libissues li
        inner JOIN library.libmags lm  ON lm.ID = li.mag
        inner JOIN library.refbooks r  ON lm.RUBRIC = r.id
        inner JOIN (
            SELECT j.name AS name, j.issn AS issn, new_r.shottitle AS shortrub, j.id AS id
            FROM journal j
            inner JOIN rubric new_r ON j.rubric_id = new_r.id
        ) AS new_journal ON lm.NAME = new_journal.name AND lm.ISSN = new_journal.issn AND r.SHORT = new_journal.shortrub
        inner JOIN issue AS new_issue ON li.CODE = new_issue.issuecode AND li.NUMBER = new_issue.issuenumber AND li.DATEIN = new_issue.issuedate 
        ORDER BY new_journal.name, new_issue.issuenumber LIMIT 1)
        ");
        $this->info('Миграция таблицы выпусков журналов успешно завершена');
        DB::select("INSERT INTO article (NAME, pages, annotation,issue_id)
        SELECT la.NAME, la.PAGE, la.ANNOT, issue.id FROM 
        library.libarticles la
        JOIN library.libissues li ON la.ISSUE = li.ID
        JOIN issue ON  li.CODE = issue.issuecode
        ");
        $this->info('Миграция таблицы журнальных статей успешно завершена');
        DB::update("UPDATE library.libbooks SET datein=NULL where datein='0000-00-00'");
        DB::select("INSERT INTO author(surname,NAME,middlename) SELECT  sname, NAME, fname FROM library.libedauth l, library.persons p
        WHERE p.ID = l.AUTHOR 
        ORDER BY sname");
        $this->info('Миграция таблицы авторы успешно завершена');
        DB::select("insert INTO book(
            NAME,
            additionalname,
            response,
            additionalresponse,
            bookinfo,
            publishplace,
            publishhouse,
            publishyear,
            tom,
            pages,
            authorsign,
            CODE,
            numbersk,
            recieptdate,
            cost,
            isbn,
            annotation,
            withraw,
            rubric_id
            ) 
           SELECT 
           lb.NAME,
           lb.NAMEADD,
           lb.RESPONS,
           lb.RESPONS1,
           lb.SOMEINFO,
           lb.ISDPLACE,
           lb.ISDNAME,
           YEAR(lb.ISDDATE),
           lb.tom,
           lb.PAGES,
           lb.AUTHSIGN,
           lb.CODE,
           lb.NomerSK,
           lb.DATEIN,
           lb.COST,
           lb.ISBN,
           lb.ANNOT,
           lb.withdraw,
           r.id
           FROM
           library.libbooks lb, library.refbooks lr, rubric r
           WHERE 
           lb.RUBRIC = lr.ID AND lr.REF = 701
           AND lr.SHORT = r.shottitle");
           DB::select("INSERT INTO statreleaserubric(title)
           SELECT name FROM library.refbooks lr
            WHERE lr.REF = 703");
           $this->info('Миграция рубрик статистических выпусков завершена');
           DB::update("UPDATE library.libstats SET datein=NULL where datein='0000-00-00'");
           DB::select("INSERT INTO statrelease(
            NAME,
            additionalname,
            response,
            publishplace,
            publishyear,
            pages,
            recieptdate,
            cost,
            CODE,
            authorsign,
            numbersk,
            rubric_id
            )
            SELECT 
            ls.NAME,
            ls.NAMEADD,
            ls.RESPONS,
            ls.ISDPLACE,
            YEAR(ls.ISDDATE),
            ls.PAGES,
            ls.DATEIN,
            ls.COST,
            ls.CODE,
            ls.AUTHSIGN,
            ls.NUMSK,
            r.id
            FROM library.libstats ls, library.refbooks lr, statreleaserubric r
            WHERE ls.RUBRIC = lr.ID 
            AND lr.NAME = r.title
            AND lr.REF = 703");
        $this->info('Миграция статистических выпусков успешно завершена');
        DB::select("INSERT INTO inforelease(NAME,NUMBER,numbersk,publishyear,rubric_id)
        SELECT 
        li.NAME,
        lf.NUMBER,
        lf.NUMSK,
        lf.ISDYEAR,
        r.id
        FROM 
        library.libinfos li
        left JOIN library.libinfiss lf ON li.ID = lf.INFORM        
          JOIN library.refbooks lr ON lf.rubricnum = lr.id
          join rubric r ON r.title = lr.NAME
        WHERE li.ID = 1  ");
        $this->info('Миграция информационных выпусков успешно завершена');  
        DB::Select("INSERT INTO infoarticle(NAME, additionalinfo,SOURCE,recieptdate)
        SELECT 
        la.NAME,
        la.addinfo,
        la.source,
        la.ISDDATE 
        FROM
        library.libinfiss AS lf
        JOIN  library.libinfos AS li
        ON  library.lf.INFORM = library.li.ID 
        JOIN library.libinfart AS la ON library.la.ISSUE = library.lf.ID 
        AND library.li.ID = 1");
        $this->info('Миграция статей информационных выпусков успешно завершена');      
        $this->info('Данные успешно скопированы');
        //return 0;
    }
}
