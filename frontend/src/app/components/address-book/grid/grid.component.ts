import { Component, OnDestroy, OnInit } from '@angular/core';
import { Subscription } from 'rxjs';
import { AddressBookService } from '../../../services/address-book.service';
import { ToasterService } from '../../../services/toaster.service';
import { CommonModule } from '@angular/common';

@Component({
  selector: 'app-grid',
  standalone: true,
  imports: [CommonModule],
  templateUrl: './grid.component.html',
  styleUrl: './grid.component.scss',
})
export class GridComponent implements OnInit, OnDestroy {
  entries: any[] = [];
  selectedId!: any;
  private subscription: Subscription = new Subscription();

  constructor(
    private addressBookService: AddressBookService,
    private toasterService: ToasterService
  ) {}

  ngOnInit() {
    this.loadEntries();
    this.subscription.add(
      this.addressBookService.currentEntry$.subscribe((entry) => {
        if (entry) {
          this.loadEntries(entry.id);
        }
      })
    );
    this.subscription.add(
      this.addressBookService.showEntryForm$.subscribe((res) => {
        if (!res) this.selectedId = '';
      })
    );
  }
  loadEntries(selectedId?: any) {
    this.addressBookService.getAllEntries().subscribe(
      (data) => {
        if (data.length > 0) {
          this.entries = data;

          if (selectedId) {
            this.selectedId = selectedId;
          }
        }
      },
      (error) => {
        this.toasterService.show('Error fetching entries.', {
          classname: 'bg-danger text-light',
          delay: 5000,
        });
      }
    );
  }

  editEntry(entry: any) {
    this.addressBookService.showEntryForm(true);
    this.addressBookService.setEntry(entry);
    this.selectedId = entry.id;
  }

  deleteEntry(entry: any) {
    this.addressBookService.deleteEntry(entry).subscribe((res) => {
      this.toasterService.show(res.message, {
        classname: 'bg-success text-light',
        delay: 5000,
      });
      this.entries = this.entries.filter((res) => res.id != entry.id);
    });
  }

  ngOnDestroy() {
    this.subscription.unsubscribe();
  }
}
