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

  setContact(contact: any) {
    this.currentContactSource.next(contact);
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

  addContact(contact: any): Observable<any> {
    return this.http.post(`${this.apiUrl}/contacts`, contact);
  }

  updateContact(contact: any): Observable<any> {
    return this.http.put(`${this.apiUrl}/contacts/${contact.id}`, contact);
  }

  deleteContact(contact: any): Observable<any> {
    return this.http.delete(`${this.apiUrl}/contacts/${contact.id}`);
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
