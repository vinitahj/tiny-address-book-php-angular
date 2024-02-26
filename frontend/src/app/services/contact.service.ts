import { HttpClient, HttpParams } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { BehaviorSubject, Observable } from 'rxjs';
import { environment } from '../../environments/environment.development';

@Injectable({
  providedIn: 'root',
})
export class ContactService {
  private apiUrl = environment.apiUrl;

  private showContactFormSource = new BehaviorSubject<boolean>(false);
  showContactForm$ = this.showContactFormSource.asObservable();

  private currentContactSource = new BehaviorSubject<any>(null);
  currentContact$ = this.currentContactSource.asObservable();

  constructor(private http: HttpClient) {}

  setContact(entry: any) {
    this.currentContactSource.next(entry);
  }

  showContactForm(flag: boolean) {
    this.showContactFormSource.next(flag);
  }

  getAllContacts(offset: number, limit: number): Observable<any> {
    // Set HTTP params
    let params = new HttpParams();
    params = params.append('offset', offset.toString());
    params = params.append('limit', limit.toString());
    return this.http.get(`${this.apiUrl}/contacts`, { params });
  }

  addContact(entry: any): Observable<any> {
    return this.http.post(`${this.apiUrl}/contacts`, entry);
  }

  updateContact(entry: any): Observable<any> {
    return this.http.put(`${this.apiUrl}/contacts/${entry.id}`, entry);
  }

  deleteContact(entry: any): Observable<any> {
    return this.http.delete(`${this.apiUrl}/contacts/${entry.id}`);
  }

  exportAs(type: string): Observable<Blob> {
    return this.http.get(`${this.apiUrl}/contacts/export/${type}`, {
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
