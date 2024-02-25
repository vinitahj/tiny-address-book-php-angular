import { Component, TemplateRef } from '@angular/core';
import { ToasterService } from '../../services/toaster.service';
import { NgbModule } from '@ng-bootstrap/ng-bootstrap';
import { CommonModule } from '@angular/common';

@Component({
  selector: 'app-toaster',
  standalone: true,
  imports: [NgbModule, CommonModule],
  templateUrl: './toaster.component.html',
  styleUrl: './toaster.component.scss',
  host: {
    class: 'toast-container position-fixed top-0 start-50 translate-middle-x',
  },
})
export class ToasterComponent {
  constructor(public toasterService: ToasterService) {}

  isTemplate(toast: any) {
    return toast.textOrTpl instanceof TemplateRef;
  }
}
