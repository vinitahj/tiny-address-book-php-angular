import { Component, OnDestroy, OnInit } from '@angular/core';
import { FormComponent } from './form/form.component';
import { CommonModule } from '@angular/common';
import { AddressBookService } from '../../services/address-book.service';
import { Subscription } from 'rxjs';
import { GridComponent } from './grid/grid.component';

@Component({
  selector: 'app-address-book',
  standalone: true,
  imports: [FormComponent, CommonModule, GridComponent],
  templateUrl: './address-book.component.html',
  styleUrl: './address-book.component.scss',
})
export class AddressBookComponent implements OnInit, OnDestroy {
  showForm: boolean = false;
  private subscription: Subscription = new Subscription();

  constructor(private addressBookService: AddressBookService) {}

  ngOnInit(): void {
    //Observe showEntryForm$ to show form whenever updated
    this.subscription.add(
      this.addressBookService.showEntryForm$.subscribe((res) => {
        this.showForm = res;
      })
    );
  }

  addForm() {
    this.addressBookService.setEntry(null);
    this.addressBookService.showEntryForm(true);
  }
  ngOnDestroy() {
    this.subscription.unsubscribe();
  }
}
