<?php

use App\Livewire\Authors\Edit;
use App\Livewire\Prueba;
use App\Livewire\Reader\CreateReader;
use App\Livewire\Reader\EditReader;
use App\Livewire\Reader\Reader;
use App\Livewire\Reader\ShowReader;
use Illuminate\Support\Facades\Route;
use App\Livewire\Authors\Show;
use App\Livewire\Authors\ShowAuthor;
use App\Livewire\BookReaders\BookReader;
use App\Livewire\BookReaders\CreateBookReader;
use App\Livewire\BookReaders\EditBookReader;
use App\Livewire\BookReaders\ShowBookReader;
use App\Livewire\Books\ShowBook;
use App\Livewire\Reports\Reports;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/authors', ShowAuthor::class)->name('authors');
    Route::get('/books', ShowBook::class)->name('books');

    //Rutas de lectores
    Route::get('/readers', Reader::class)->name('reader.index');
    Route::get('/readers/create', CreateReader::class)->name('reader.create');
    Route::get('/readers/{reader}/edit', EditReader::class)->name('reader.edit');
    Route::get('/readers/{reader}/show', ShowReader::class)->name('reader.show');


    //Rutas de lectores de libros
    Route::get('/book-readers', BookReader::class)->name('book-reader.index');
    Route::get('/book-readers/create', CreateBookReader::class)->name('book-reader.create');
    Route::get('/book-readers/{book_reader}/edit', EditBookReader::class)->name('book-reader.edit');
    Route::get('/book-readers/{book_reader}/show', ShowBookReader::class)->name('book-reader.show');

    // Rutas de reportes
    Route::get('/reports', Reports::class)->name('report.index');
});
