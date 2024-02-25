import { Component } from '@angular/core';
import { HeaderComponent } from './components/header/header.component';
import { FooterComponent } from './components/footer/footer.component';
import { AddressBookComponent } from './components/address-book/address-book.component';
import { ToasterComponent } from './components/toaster/toaster.component';
import { AddressBookService } from './services/address-book.service';
import { HttpClientModule } from '@angular/common/http';

@Component({
  selector: 'app-root',
  standalone: true,
  imports: [
    HeaderComponent,
    FooterComponent,
    AddressBookComponent,
    HttpClientModule,
    ToasterComponent,
  ],
  templateUrl: './app.component.html',
  styleUrl: './app.component.scss',
  providers: [AddressBookService],
})
export class AppComponent {
  title = 'frontend';
}
