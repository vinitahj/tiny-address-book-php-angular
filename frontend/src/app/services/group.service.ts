import { HttpClient, HttpParams } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { BehaviorSubject, Observable } from 'rxjs';
import { environment } from '../../environments/environment';

@Injectable({
  providedIn: 'root',
})
export class GroupService {
  private apiUrl = environment.apiUrl;

  private showGroupFormSource = new BehaviorSubject<boolean>(false);
  showGroupForm$ = this.showGroupFormSource.asObservable();

  private currentGroupSource = new BehaviorSubject<any>(null);
  currentGroup$ = this.currentGroupSource.asObservable();

  constructor(private http: HttpClient) {}

  setGroup(group: any) {
    this.currentGroupSource.next(group);
  }

  showGroupForm(flag: boolean) {
    this.showGroupFormSource.next(flag);
  }

  getAllGroups(offset: number, limit: number): Observable<any> {
    // Set HTTP params
    let params = new HttpParams();
    params = params.append('offset', offset.toString());
    params = params.append('limit', limit.toString());
    return this.http.get(`${this.apiUrl}/groups`, { params });
  }

  addGroup(group: any): Observable<any> {
    return this.http.post(`${this.apiUrl}/groups`, group);
  }

  updateGroup(group: any): Observable<any> {
    return this.http.put(`${this.apiUrl}/groups/${group.id}`, group);
  }

  deleteGroup(group: any): Observable<any> {
    return this.http.delete(`${this.apiUrl}/groups/${group.id}`);
  }
}
