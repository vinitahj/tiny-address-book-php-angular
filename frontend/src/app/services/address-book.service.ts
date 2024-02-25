import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { BehaviorSubject, Observable } from 'rxjs';

@Injectable({
  providedIn: 'root',
})
export class AddressBookService {
  private apiUrl =
    'http://localhost/tiny-address-book-php-angular/backend/public';

  private showEntryFormSource = new BehaviorSubject<boolean>(false);
  showEntryForm$ = this.showEntryFormSource.asObservable();

  private currentEntrySource = new BehaviorSubject<any>(null);
  currentEntry$ = this.currentEntrySource.asObservable();

  constructor(private http: HttpClient) {}

  setEntry(entry: any) {
    this.currentEntrySource.next(entry);
  }

  showEntryForm(flag: boolean) {
    this.showEntryFormSource.next(flag);
  }

  getAllEntries(): Observable<any> {
    return this.http.get(`${this.apiUrl}/entries`);
  }

  getCities(): Observable<any> {
    return this.http.get(`${this.apiUrl}/cities`);
  }

  addEntry(entry: any): Observable<any> {
    return this.http.post(`${this.apiUrl}/entries`, entry);
  }

  updateEntry(entry: any): Observable<any> {
    return this.http.put(`${this.apiUrl}/entries/${entry.id}`, entry);
  }

  deleteEntry(entry: any): Observable<any> {
    return this.http.delete(`${this.apiUrl}/entries/${entry.id}`);
  }

  exportAs(type: string): Observable<Blob> {
    return this.http.get(`${this.apiUrl}/entries/export/${type}`, {
      responseType: 'blob',
    });
  }

  downloadFile(data: Blob, filename: string) {
    const a = document.createElement('a');
    const objectUrl = URL.createObjectURL(data);
    a.href = objectUrl;
    a.download = filename;
    a.click();
    URL.revokeObjectURL(objectUrl);
  }
}
