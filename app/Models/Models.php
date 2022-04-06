<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Models extends model
{
  public function user()
  {
    $user = new User();

    return $user;
  }

  public function faculty()
  {
    $faculty = new Faculty();

    return $faculty;
  }

  public function previleges()
  {
    $previleges = new Previleges();

    return $previleges;
  }

  public function book()
  {
    $book = new Book();

    return $book;
  }
  public function bookDetail()
  {
    $bookDetail = new BookDetail();

    return $bookDetail;
  }

  public function catalog()
  {
    $catalog = new Catalog();

    return $catalog;
  }

  public function publisher()
  {
    $publisher = new Publisher();

    return $publisher;
  }
  public function author()
  {
    $author = new Author();

    return $author;
  }
  public function category()
  {
    $category = new Category();

    return $category;
  }
  public function major()
  {
    $major = new Major();

    return $major;
  }
  public function bookshelf()
  {
    $bookshelf = new Bookshelf();

    return $bookshelf;
  }
  public function bookshelfDetail()
  {
    $bookshelfDetail = new BookshelfDetail();

    return $bookshelfDetail;
  }
  public function bookLoan()
  {
    $bookLoan = new BookLoan();

    return $bookLoan;
  }
  public function bookLoanDetail()
  {
    $bookLoanDetail = new BookLoanDetail();

    return $bookLoanDetail;
  }
  public function bookReturn()
  {
    $bookReturn = new BookReturn();

    return $bookReturn;
  }
  public function bookReturnDetail()
  {
    $bookReturnDetail = new BookReturnDetail;

    return $bookReturnDetail;
  }
  public function log()
  {
    $Log = new Log();

    return $Log;
  }
}