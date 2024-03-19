import { Component, OnDestroy, OnInit } from '@angular/core';
import { FormComponent } from './form/form.component';
import { GridComponent } from './grid/grid.component';
import { Subscription } from 'rxjs';
import { GroupService } from '../../services/group.service';
import { CommonModule } from '@angular/common';

@Component({
  selector: 'app-groups',
  standalone: true,
  imports: [FormComponent, GridComponent, CommonModule],
  templateUrl: './groups.component.html',
  styleUrl: './groups.component.scss',
})
export class GroupsComponent implements OnInit, OnDestroy {
  showForm: boolean = false;
  private subscription: Subscription = new Subscription();

  constructor(private groupService: GroupService) {}

  ngOnInit(): void {
    //Observe showGroupForm$ to show form whenever updated
    this.subscription.add(
      this.groupService.showGroupForm$.subscribe((res) => {
        this.showForm = res;
      })
    );
  }

  addForm() {
    this.groupService.setGroup(null);
    this.groupService.showGroupForm(true);
  }

  ngOnDestroy() {
    this.subscription.unsubscribe();
  }
}
