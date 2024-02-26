import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { environment } from '../../environments/environment';

@Injectable({
  providedIn: 'root',
})
export class CityService {
  private apiUrl = environment.apiUrl;

  constructor(private http: HttpClient) {}
  getAll(): Observable<any> {
    return this.http.get(`${this.apiUrl}/cities`);
  }
}
