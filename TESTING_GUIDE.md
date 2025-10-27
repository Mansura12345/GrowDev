# 🧪 Testing Guide - Documentation Feature

## Prerequisites

- ✅ Laravel server running on http://127.0.0.1:8000
- ✅ Database migrations executed
- ✅ User account created and logged in
- ✅ Browser with JavaScript enabled

---

## 📋 SRS Document Testing

### Test 1: Create SRS Document

**Steps:**
1. Navigate to http://127.0.0.1:8000
2. Click the green "📄 Create Documentation" button
3. Hover and select "📋 Create SRS Document"
4. Fill in the form:
   - Title: "E-Commerce Platform SRS"
   - Description: "Requirements for building an e-commerce platform"
   - Project Overview: "Modern, scalable e-commerce platform"
   - Scope: "User authentication, product catalog, shopping cart, checkout"
   - Constraints: "Must support 10,000 concurrent users"
   - Assumptions: "Users have modern browsers"
5. Click "✅ Create SRS" button

**Expected Result:**
- Redirected to edit page for new SRS
- Form pre-filled with provided information
- Add Requirement button visible
- Success message displayed

---

### Test 2: Add Functional Requirements

**Steps:**
1. On the SRS edit page, click "+ Add Requirement"
2. Fill in the requirement:
   - Requirement ID: REQ-001
   - Title: "User Registration"
   - Description: "Users can register with email and password"
   - Priority: High
3. Click "+ Add UX Item" (in same requirement)
4. Add UX items:
   - "Responsive design - works on mobile"
   - "Email validation feedback"
   - "Password strength indicator"
5. Click "+ Add Requirement" again
6. Add second requirement:
   - Requirement ID: REQ-002
   - Title: "Product Search"
   - Description: "Users can search products by name, category, price range"
   - Priority: Critical
7. Add UX items to REQ-002:
   - "Real-time search results"
   - "Filter refinement sidebar"
   - "Search suggestions dropdown"

**Expected Result:**
- Two requirement items visible on page
- Each has add UX item button
- UX items display with remove buttons
- No page reload when adding items
- Professional styling applied

---

### Test 3: Manage Requirements (Edit/Remove)

**Steps:**
1. On requirement REQ-002, change priority to "Medium"
2. Click "+ Add UX Item" and add: "Dark mode support"
3. Remove the "Search suggestions dropdown" UX item by clicking ✕
4. Click "+ Add Requirement" and add REQ-003
5. Immediately click "Remove Requirement" on REQ-003
6. Verify REQ-001 and REQ-002 remain

**Expected Result:**
- Priority changes reflected immediately
- UX items added and removed without errors
- Requirements can be added and removed
- Form state properly maintained

---

### Test 4: Save SRS Document

**Steps:**
1. With filled SRS (title, requirements, UX items), click "💾 Save SRS"
2. Wait for page to process
3. Should see success message

**Expected Result:**
- Form validation passes
- Document saved to database
- Redirected to edit page
- Success message displayed
- Data persists on reload

---

### Test 5: Export SRS as PDF

**Steps:**
1. On the edit page, click "📥 Export PDF"
2. PDF should download

**Expected Result:**
- PDF downloads with name "SRS_[title].pdf"
- PDF contains:
  - Document header with title and dates
  - All sections (Overview, Scope, Constraints, Assumptions)
  - All functional requirements with:
    - Requirement ID and Title
    - Priority badge (color-coded)
    - Description
    - UX Considerations list
  - Professional formatting and layout
  - Created/Updated timestamps

---

### Test 6: View SRS List

**Steps:**
1. From dropdown menu, click "📑 View SRS Documents"
2. Or navigate to http://127.0.0.1:8000/documentation/srs

**Expected Result:**
- List of all user's SRS documents displayed
- Each document shows:
  - Title
  - Description preview
  - Number of requirements
  - Creation date
  - Edit, PDF, Delete buttons
- Can click Edit or PDF from list

---

### Test 7: Edit Existing SRS

**Steps:**
1. On SRS list, click "✏️ Edit" for your document
2. Change title to "E-Commerce Platform SRS v2"
3. Add a new requirement REQ-004
4. Click "💾 Save SRS"

**Expected Result:**
- Changes saved successfully
- Redirected to edit page
- Title updated in heading
- New requirement persists
- List shows updated title

---

### Test 8: Delete SRS

**Steps:**
1. On SRS list, click "🗑️ Delete" button
2. Confirm deletion in dialog

**Expected Result:**
- Document removed from database
- Removed from list
- Success message displayed
- User redirected to SRS list

---

## 🏗️ SDD Document Testing

### Test 9: Create SDD Document

**Steps:**
1. From dropdown, select "🏗️ Create SDD Document"
2. Fill form:
   - Title: "E-Commerce Platform SDD"
   - Description: "System design for e-commerce platform"
   - Design Overview: "Three-tier architecture with API gateway"
   - Architecture Overview: "Microservices-based architecture"
3. Click "✅ Create SDD"

**Expected Result:**
- Redirected to SDD edit page
- Form pre-filled
- Components and Diagrams sections visible
- Add Component button visible

---

### Test 10: Add Components

**Steps:**
1. Click "+ Add Component" button
2. Fill component 1:
   - Component Name: "User Service"
   - Description: "Handles user authentication and profile management"
   - Responsibility: "User registration, login, profile updates"
   - Interfaces: "REST API - /users, /auth"
   - Diagram Type: "Mermaid Diagram"
3. Click "+ Add Component" again
4. Fill component 2:
   - Component Name: "Product Service"
   - Description: "Manages product catalog and search"
   - Responsibility: "Product CRUD, search indexing"
   - Interfaces: "REST API - /products, /search"

**Expected Result:**
- Two components added
- Each shows in form section
- Professional styling applied
- Remove component buttons functional

---

### Test 11: Create Text-to-Diagram (Mermaid)

**Steps:**
1. In Diagrams section, find "✨ AI Convert Text" tab
2. Click it to activate
3. In text area, enter:
   ```
   The user opens the app and logs in. The system sends
   credentials to the User Service. If valid, returns JWT token.
   User uses token for API requests to Product Service.
   ```
4. Select diagram type: "Sequence Diagram"
5. Click "🔄 Generate Mermaid Diagram"
6. Wait for preview to appear

**Expected Result:**
- Text is sent to API endpoint
- Mermaid diagram generated based on text
- Preview shows sequence diagram
- "✅ Save this Diagram" button appears
- No errors in console

---

### Test 12: Save Generated Diagram

**Steps:**
1. After preview appears, click "✅ Save this Diagram"
2. Diagram should appear in "Saved Diagrams" section

**Expected Result:**
- Diagram appears under "Saved Diagrams"
- Shows diagram name (auto-generated)
- Shows diagram type
- Displays rendered Mermaid diagram
- Remove button available
- Input fields added to form for submission

---

### Test 13: Create Manual Mermaid Diagram

**Steps:**
1. Click "📐 Create Manual Diagram" tab
2. Enter diagram name: "System Architecture"
3. Enter Mermaid code:
   ```
   graph TD
       A[Client] -->|REST API| B[API Gateway]
       B --> C[User Service]
       B --> D[Product Service]
       C --> E[(User DB)]
       D --> F[(Product DB)]
   ```
4. Click "👁️ Preview Diagram"

**Expected Result:**
- Diagram renders in preview area
- Shows the architecture diagram
- Preview box becomes visible
- "✅ Save this Diagram" button available

---

### Test 14: Save Manual Diagram

**Steps:**
1. Click "✅ Save this Diagram"
2. Diagram added to saved list

**Expected Result:**
- Diagram appears in "Saved Diagrams"
- Named "System Architecture"
- Type shows as "mermaid"
- Diagram renders correctly

---

### Test 15: Add Multiple Diagram Types

**Steps:**
1. Create another manual diagram with name "Database Schema" and code:
   ```
   classDiagram
       class User {
           +id: int
           +email: string
           +password: string
           +register()
           +login()
       }
       class Product {
           +id: int
           +name: string
           +price: float
           +getDetails()
       }
   ```
2. Save it
3. Create a flowchart diagram

**Expected Result:**
- Multiple diagrams can coexist
- Each displays correctly
- All saved in "Saved Diagrams" section
- Form contains all diagrams for submission

---

### Test 16: Save SDD with Components and Diagrams

**Steps:**
1. Click "💾 Save SDD"

**Expected Result:**
- All components saved
- All diagrams saved
- Form validates successfully
- Success message shown
- Redirected to edit page
- All data persists on reload

---

### Test 17: Remove Diagram

**Steps:**
1. In "Saved Diagrams", find a diagram
2. Click "✕ Remove" button

**Expected Result:**
- Diagram removed from list
- Hidden input removed from form
- Other diagrams unaffected

---

### Test 18: Export SDD as PDF

**Steps:**
1. Click "📥 Export PDF" button
2. Wait for PDF generation
3. PDF should download

**Expected Result:**
- PDF downloads as "SDD_[title].pdf"
- PDF contains:
  - Header with title and dates
  - Design and Architecture overviews
  - All components with descriptions
  - All diagrams rendered as images
  - Component interfaces and responsibilities
  - Professional formatting
  - Footer with generation timestamp

---

### Test 19: View SDD List

**Steps:**
1. From dropdown, click "🔧 View SDD Documents"
2. Or navigate to http://127.0.0.1:8000/documentation/sdd

**Expected Result:**
- List shows all user's SDD documents
- Each shows title, description, component count
- Edit, PDF, Delete buttons available

---

### Test 20: Edit Existing SDD

**Steps:**
1. From SDD list, click "✏️ Edit"
2. Add new component: "Cache Service"
3. Save changes

**Expected Result:**
- Changes persist
- New component visible in list
- Diagrams remain unchanged

---

## 🔒 Authorization Testing

### Test 21: Document Ownership

**Steps:**
1. Create SRS document as User A
2. Log out
3. Create new account (User B)
4. Log in as User B
5. Try to access User A's SRS directly via URL:
   `/documentation/srs/{user-a-document-id}/edit`

**Expected Result:**
- Access denied
- 403 Forbidden error or redirect
- User B cannot modify User A's documents

---

## 🔧 Edge Cases & Error Handling

### Test 22: Empty Fields Validation

**Steps:**
1. Try to create SRS without title
2. Try to add requirement without title
3. Try to add UX item without text

**Expected Result:**
- Validation errors displayed
- Form not submitted
- User-friendly error messages

---

### Test 23: Long Text Handling

**Steps:**
1. Add requirement with very long description (>1000 chars)
2. Add many UX items (10+)
3. Export to PDF

**Expected Result:**
- Text wraps properly
- No layout issues
- PDF renders correctly
- All content visible

---

### Test 24: Special Characters in Diagrams

**Steps:**
1. Create diagram with special characters in name: `User@Login#123`
2. Create diagram with special chars in code

**Expected Result:**
- Special characters properly escaped
- No errors or corruption
- PDF renders correctly

---

## 📱 Responsive Design Testing

### Test 25: Mobile View

**Steps:**
1. Open SRS/SDD edit page on mobile browser (or use DevTools)
2. Try to:
   - Scroll through requirements
   - Add/remove UX items
   - Click buttons
   - View forms

**Expected Result:**
- Layout adapts to screen size
- All buttons clickable
- Forms readable
- No horizontal scrolling needed
- Touch-friendly spacing

---

## 🎨 Visual Quality Testing

### Test 26: UI/UX Polish

**Steps:**
1. Review colors and contrast
2. Check button hover states
3. Verify spacing and alignment
4. Check font readability
5. Review PDF styling

**Expected Result:**
- Professional appearance
- Consistent color scheme
- Clear visual hierarchy
- Proper spacing throughout
- PDF looks print-ready

---

## 📊 Data Persistence Testing

### Test 27: Database Integrity

**Steps:**
1. Create SRS with requirements
2. Check database directly (or through Laravel):
   ```bash
   php artisan tinker
   >>> SrsDocument::first()
   >>> SrsDocument::first()->functionalRequirements
   ```

**Expected Result:**
- Data correctly stored in database
- Relationships work properly
- JSON columns properly formatted
- No data loss

---

## Performance Testing

### Test 28: Load with Multiple Documents

**Steps:**
1. Create 5-10 SRS documents
2. Create 5-10 SDD documents with multiple diagrams
3. Load list pages
4. Load edit pages

**Expected Result:**
- Pages load quickly (< 2 seconds)
- No lag when adding/removing items
- PDF generation completes in reasonable time
- No console errors

---

## 🎉 Final Verification Checklist

- [ ] SRS: Create, Read, Update, Delete ✅
- [ ] SRS: Functional Requirements Management ✅
- [ ] SRS: UX Considerations (Add/Remove) ✅
- [ ] SRS: PDF Export ✅
- [ ] SDD: Create, Read, Update, Delete ✅
- [ ] SDD: Components Management ✅
- [ ] SDD: Text-to-Diagram Conversion ✅
- [ ] SDD: Manual Mermaid Diagrams ✅
- [ ] SDD: PDF Export with Diagrams ✅
- [ ] Authorization: Users can only access own documents ✅
- [ ] Validation: Form errors handled properly ✅
- [ ] UI: Responsive design works ✅
- [ ] UI: Professional appearance ✅
- [ ] Database: Data properly persisted ✅
- [ ] Performance: Pages load quickly ✅

---

**Testing Guide Version**: 1.0
**Last Updated**: October 21, 2025
**Status**: Ready for Testing ✅
