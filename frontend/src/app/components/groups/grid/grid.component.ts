import { Component, OnDestroy, OnInit } from '@angular/core';
import { Subscription } from 'rxjs';
import { GroupService } from '../../../services/group.service';
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
  groups: any[] = [];
  selectedId!: any;
  private subscription: Subscription = new Subscription();

  private offset = 0;
  private limit = 10;
  allGroupsLoaded = false; // Flag to indicate all groups are loaded

  constructor(
    private groupService: GroupService,
    private toasterService: ToasterService
  ) {}

  ngOnInit() {
    this.loadGroups();
    this.subscription.add(
      this.groupService.currentGroup$.subscribe((group) => {
        if (group) {
          this.loadGroups(true, group.id);
        }
      })
    );
    this.subscription.add(
      this.groupService.showGroupForm$.subscribe((res) => {
        if (!res) this.selectedId = '';
      })
    );
  }
  loadGroups(reset = false, selectedId?: any) {
    if (reset) {
      this.offset = 0; // Reset offset
      this.groups = []; // Reset groups array
      this.allGroupsLoaded = false; // Reset the flag
    }
    this.groupService.getAllGroups(this.offset, this.limit).subscribe(
      (data) => {
        if (data.length > 0) {
          this.groups = [...this.groups, ...data];
          this.offset += this.limit;
          if (selectedId) {
            this.selectedId = selectedId;
          }
          this.allGroupsLoaded = data.length < this.limit;
        } else {
          this.allGroupsLoaded = true;
        }
      },
      (error) => {
        this.toasterService.show('Error fetching groups.', {
          classname: 'bg-danger text-light',
          delay: 5000,
        });
      }
    );
  }

  editGroup(group: any) {
    this.groupService.showGroupForm(true);
    this.groupService.setGroup(group);
    this.selectedId = group.id;
  }

  deleteGroup(group: any) {
    this.groupService.deleteGroup(group).subscribe((res) => {
      this.toasterService.show(res.message, {
        classname: 'bg-success text-light',
        delay: 5000,
      });
      this.groupService.setGroup(null);
      this.loadGroups(true);
    });
  }

  ngOnDestroy() {
    this.subscription.unsubscribe();
  }
}
