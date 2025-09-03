# Post-Adoption Monitoring System - Setup Instructions

## Database Setup

1. **Run the SQL file to create tables:**

   ```bash
   # In your MySQL/phpMyAdmin, import the following file:
   monitoring_system_tables.sql
   ```

2. **Or run these commands directly in your MySQL:**
   ```sql
   -- Copy and paste the content from monitoring_system_tables.sql
   ```

## Demo Credentials

### Admin Access:

- URL: `http://localhost/carelink/admin/auth/sign-in.php`
- Use your existing admin credentials

### Officer Access:

- URL: `http://localhost/carelink/admin/auth/officer-login.php`
- **Officer ID:** `OFF001`
- **Password:** `officer123`
- **Name:** John Smith (Colombo District)

- **Officer ID:** `OFF002`
- **Password:** `officer123`
- **Name:** Sarah Johnson (Kandy District)

## System Flow

### Admin Workflow:

1. **Login** → Admin Dashboard
2. **Adopted Children** → Add new adopted children
3. **View Reports** → Monitor officer visit reports
4. **Manage System** → Oversee monitoring activities

### Officer Workflow:

1. **Login** → Officer Dashboard
2. **Select Child** → Click on child card to start visit
3. **Fill Report** → Complete assessment scores and observations
4. **Submit** → Report saved and admin notified

## Features Implemented

### ✅ Admin Interface:

- **Adopted Children Management** - Add, view, update status
- **Statistics Dashboard** - Overview of monitoring activities
- **Visit Reports Viewing** - Review officer submissions
- **Responsive Design** - Works on all devices

### ✅ Officer Interface:

- **Separate Login System** - Secure officer authentication
- **Dashboard** - View assigned children and statistics
- **Interactive Visit Forms** - Score sliders, detailed observations
- **Child Information** - Full child and family details

### ✅ Assessment System:

- **5-Point Scoring** - Physical, mental, educational, social, family bonding
- **Detailed Observations** - Text fields for comprehensive notes
- **Risk Indicators** - Follow-up and urgent intervention flags
- **Next Visit Scheduling** - Automatic due date setting

## File Structure

```
/admin/pages/
├── adopted_children.php          # Admin: Manage adopted children
├── officer_dashboard.php         # Officer: Dashboard and child selection
├── visit_form.php                # Officer: Visit report form
└── view_child_profile.php        # View child details and history

/admin/auth/
├── officer-login.php             # Officer login page
└── officer-logout.php            # Officer logout

/monitoring_system_tables.sql     # Database setup script
```

## Next Steps (Future Enhancements)

1. **AI Analysis Integration** - Analyze patterns in visit reports
2. **SMS Notifications** - Alert admin for urgent cases
3. **Photo Upload** - Allow officers to attach visit photos
4. **Mobile App** - Native mobile app for officers
5. **Advanced Reporting** - Generate compliance reports
6. **Calendar Integration** - Visit scheduling system

## Security Features

- **Separate Authentication** - Officers and admins use different login systems
- **Session Management** - Secure session handling
- **Data Validation** - Form input validation and sanitization
- **Access Control** - Role-based access restrictions

## Support

For technical support or additional features, contact the development team.
