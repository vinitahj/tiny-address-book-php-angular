import { CommonModule } from '@angular/common';
import { Component } from '@angular/core';
import {
  FormControl,
  FormGroup,
  ReactiveFormsModule,
  Validators,
} from '@angular/forms';
import { Subscription } from 'rxjs';
import { GroupService } from '../../../services/group.service';
import { ToasterService } from '../../../services/toaster.service';

@Component({
  selector: 'app-form',
  standalone: true,
  imports: [ReactiveFormsModule, CommonModule],
  templateUrl: './form.component.html',
  styleUrl: './form.component.scss',
})
export class FormComponent {
  groupForm!: FormGroup;
  cities: any[] = [];
  private subscription: Subscription = new Subscription();

  constructor(
    private groupService: GroupService,
    private toasterService: ToasterService
  ) {}

  ngOnInit() {
    this.createForm();
    this.loadModel();
  }

  createForm() {
    this.groupForm = new FormGroup({
      id: new FormControl(''),
      name: new FormControl('', Validators.required),
      description: new FormControl('', Validators.required),
    });
  }

  onCancel() {
    this.groupForm.reset();
    this.groupService.showGroupForm(false);
  }

  hasError(field: string) {
    return (
      this.groupForm.get(field)?.invalid && this.groupForm.get(field)?.touched
    );
  }

  onSubmit() {
    if (this.groupForm.valid) {
      if (this.groupForm.value.id) {
        this.updateModel();
      } else {
        this.addModel();
      }
    } else {
      this.groupForm.markAllAsTouched();
    }
  }

  loadModel() {
    this.subscription.add(
      this.groupService.currentGroup$.subscribe((group) => {
        if (group) {
          this.groupForm.patchValue(group);
        } else {
          this.groupForm.reset();
          this.groupForm.patchValue({ city_id: '' });
        }
      })
    );
  }
  addModel() {
    this.subscription.add(
      this.groupService.addGroup(this.groupForm.value).subscribe((res) => {
        if (res.data) {
          this.groupService.setGroup(res.data);
          this.toasterService.show(res.message, {
            classname: 'bg-success text-light',
            delay: 5000,
          });
        }
      })
    );
  }

  updateModel() {
    this.subscription.add(
      this.groupService.updateGroup(this.groupForm.value).subscribe((res) => {
        if (res.data) {
          this.groupService.setGroup(this.groupForm.value);
          this.toasterService.show(res.message, {
            classname: 'bg-success text-light',
            delay: 5000,
          });
        }
      })
    );
  }

  ngOnDestroy() {
    this.subscription.unsubscribe();
  }
}
