@extends('layouts_frontend._main')

@section('content')
<section class="premium-section spad">
    <div class="container">
        <div class="section-title">
            <h2>About</h2>
        </div>
        <section class="songs-details-section">
            <div class="container-fluid">
                <div class="song-details-box">
                    <p class="mb-3">
                        <h3>Specification</h3>
                        <ul>
                            <li><strong>DBMS:</strong><span>PostGreSQL</span></li>
                            <li><strong>Visual Canvas:</strong><span>Creately</span></li>
                            <li><strong>Web UI Mockup Tools:</strong><span>Protopie</span></li>
                        </ul>
                    </p>
                </div>
                <div class="song-details-box">
                    <h3>Provisions</h3>
                    <p class="text-justify">
                        XYZ university library is a fairly large library that has
                        approximately 10,000 members, 100,000 book titles with a total collection of 250,000 (annually
                        an average of 2.5 copies per book). At any time, about 10 percent of the total collection
                        the
                        is on borrowed status. Librarians strive to ensure that books are
                        that the members want to borrow is available when the members want to borrow
                        these books. Moreover, librarians must know for sure at all times
                        how many copies of each book are collected by the library and how many
                        is on borrowed status. A catalog of all collected books is available
                        on line. This catalog presents a list of books consisting of authors, titles, and areas
                        the subject. For each book title, the description of the book can be one sentence up to
                        several pages, recorded in the catalog. Librarian in charge of reference section
                        want to be able to access the description when there is a request for information
                        about the books of its members. The library staff consists of the head of the library,
                        librarian associated with the department, reference librarian, staff for borrowing,
                        and assistant librarian.
                    </p>
                    <p class="text-justify">
                        A book can be borrowed for a maximum of 21 days. At all times,
                        each library member is only allowed to borrow five books. The members
                        library
                        usually returns borrowed books within three to four weeks.
                        Most members know that they have a grace period of one
                        weeks before a warning was sent to them, so they tried to
                        return borrowed books before the grace period ends. About 5 percent
                        of members must be sent a warning to return the book. Most of the books
                        whose borrowing period has expired is returned within one month after the limit
                        payback time. Approximately 5 percent of the books that have been borrowed time
                        exceeded never returned. The category of the most active library members is given
                        to those who borrow books at least 10 times a year.
                        The top one percent of members borrow as much as 15 percent, and 10 percent of members
                        40 percent borrowed. About 20 percent of the members are members
                        inactive, namely members who have never made a loan.
                    </p>
                    <p class="text-justify">
                        To become a member of the library, applicants must fill out a form that contains
                        student registration number, campus address and permanent address, and several telephone
                        numbers.
                        The librarian provides a membership card whose numbers can be read automatically by the machine
                        and
                        accompanied by a photo. The membership card is valid for four years. One month
                        before
                        The card expires, a warning is sent to the member to renew.
                        University lecturers are automatically enrolled as members. For this, if there is a lecturer
                        new who join the university, information from the new lecturer is taken from the base
                        lecturer data and library member cards are sent to the address of the campus concerned. Para
                        lecturer
                        allowed to borrow books for three months and not
                        a grace period of two weeks. Warning regarding the extension of borrowed books
                        by the lecturers sent to their campus address. Libraries don't lend to some
                        special books, such as reference books, rare category books, and maps. Para
                        the librarian must be able to distinguish between borrowed books and books
                        which is not allowed to be borrowed. In addition, librarians have one list of several
                        interesting books to have for libraries but can't get hold of, like
                        rare books and books that are declared missing or damaged but have not been replaced. Para
                        librarians must be facilitated by a system that can record books that are not
                        borrowed and books that need to be held. Hence several books can be
                        having the same title, the book title cannot be used as an identification tool.
                        Every book is identified by its International Standard Book Number (ISBN)
                        is a unique international code for each book registered with the institution
                        the ISBN provider. Two books with the same title can have different ISBNs
                        if both are written in different languages ​​or if both have different covers
                        different (hardcover or softcover). Each edition of the same book has its ISBN
                        different. The database system to be developed must be designed to record
                        regarding library members, all collected books, catalogs, and lending activities
                        book.</p>
                </div>
            </div>
        </section>
    </div>
</section>
@endsection