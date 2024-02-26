import { Component } from '@angular/core';
import { HeaderComponent } from './components/header/header.component';
import { FooterComponent } from './components/footer/footer.component';
import { ToasterComponent } from './components/toaster/toaster.component';
import { HttpClientModule } from '@angular/common/http';
import { ContactService } from './services/contact.service';
import { ContactsComponent } from './components/contacts/contacts.component';
import { CityService } from './services/city.service';

@Component({
  selector: 'app-root',
  standalone: true,
  imports: [
    HeaderComponent,
    FooterComponent,
    ContactsComponent,
    HttpClientModule,
    ToasterComponent,
  ],
  templateUrl: './app.component.html',
  styleUrl: './app.component.scss',
  providers: [ContactService, CityService],
})
export class AppComponent {
  title = 'frontend';
}
