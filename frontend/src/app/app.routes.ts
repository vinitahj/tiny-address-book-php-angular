import { Routes } from '@angular/router';
import { GroupsComponent } from './components/groups/groups.component';
import { ContactsComponent } from './components/contacts/contacts.component';

export const routes: Routes = [
  {
    path: 'groups',
    component: GroupsComponent,
  },
  {
    path: 'contacts',
    component: ContactsComponent,
  },
];
