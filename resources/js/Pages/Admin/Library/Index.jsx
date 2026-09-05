import AppLayout from '@/layouts/AppLayout';
import { useForm, router } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import { Dialog, DialogContent, DialogHeader, DialogTitle, DialogTrigger } from '@/components/ui/dialog';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import { useState } from 'react';
import { Plus, BookOpen } from 'lucide-react';

export default function Index({ books, stats }) {
    const [addOpen, setAddOpen] = useState(false);
    const [issueOpen, setIssueOpen] = useState(false);

    const addForm = useForm({ title: '', author: '', isbn: '', quantity: '', category: '' });
    const issueForm = useForm({ book_id: '', student_id: '', due_date: '' });

    const handleAdd = (e) => {
        e.preventDefault();
        addForm.post(route('admin.library.books.store'), { onSuccess: () => { addForm.reset(); setAddOpen(false); } });
    };

    const handleIssue = (e) => {
        e.preventDefault();
        issueForm.post(route('admin.library.issues.store'), { onSuccess: () => { issueForm.reset(); setIssueOpen(false); } });
    };

    const statCards = [
        { title: 'Total Books', value: stats?.total || 0 },
        { title: 'Available', value: stats?.available || 0 },
        { title: 'Issued', value: stats?.issued || 0 },
        { title: 'Overdue', value: stats?.overdue || 0 },
    ];

    return (
        <AppLayout title="Library">
            <div className="space-y-6">
                <div className="flex items-center justify-between">
                    <div>
                        <h1 className="text-2xl font-bold tracking-tight">Library</h1>
                        <p className="text-muted-foreground">Manage books and issues.</p>
                    </div>
                    <div className="flex gap-2">
                        <Dialog open={issueOpen} onOpenChange={setIssueOpen}>
                            <DialogTrigger asChild>
                                <Button variant="outline"><BookOpen className="mr-2 h-4 w-4" /> Issue Book</Button>
                            </DialogTrigger>
                            <DialogContent>
                                <DialogHeader><DialogTitle>Issue Book</DialogTitle></DialogHeader>
                                <form onSubmit={handleIssue} className="space-y-4">
                                    <div className="space-y-2">
                                        <Label>Book</Label>
                                        <Select value={issueForm.data.book_id} onValueChange={(v) => issueForm.setData('book_id', v)}>
                                            <SelectTrigger><SelectValue placeholder="Select book" /></SelectTrigger>
                                            <SelectContent>
                                                {books?.filter((b) => b.available_count > 0).map((b) => (
                                                    <SelectItem key={b.id} value={String(b.id)}>{b.title}</SelectItem>
                                                ))}
                                            </SelectContent>
                                        </Select>
                                    </div>
                                    <div className="space-y-2">
                                        <Label htmlFor="student_id">Student ID</Label>
                                        <Input id="student_id" value={issueForm.data.student_id} onChange={(e) => issueForm.setData('student_id', e.target.value)} />
                                    </div>
                                    <div className="space-y-2">
                                        <Label htmlFor="due_date">Due Date</Label>
                                        <Input id="due_date" type="date" value={issueForm.data.due_date} onChange={(e) => issueForm.setData('due_date', e.target.value)} />
                                    </div>
                                    <Button type="submit" disabled={issueForm.processing} className="w-full">Issue</Button>
                                </form>
                            </DialogContent>
                        </Dialog>

                        <Dialog open={addOpen} onOpenChange={setAddOpen}>
                            <DialogTrigger asChild>
                                <Button><Plus className="mr-2 h-4 w-4" /> Add Book</Button>
                            </DialogTrigger>
                            <DialogContent>
                                <DialogHeader><DialogTitle>Add Book</DialogTitle></DialogHeader>
                                <form onSubmit={handleAdd} className="space-y-4">
                                    <div className="space-y-2">
                                        <Label htmlFor="title">Title</Label>
                                        <Input id="title" value={addForm.data.title} onChange={(e) => addForm.setData('title', e.target.value)} />
                                    </div>
                                    <div className="space-y-2">
                                        <Label htmlFor="author">Author</Label>
                                        <Input id="author" value={addForm.data.author} onChange={(e) => addForm.setData('author', e.target.value)} />
                                    </div>
                                    <div className="space-y-2">
                                        <Label htmlFor="isbn">ISBN</Label>
                                        <Input id="isbn" value={addForm.data.isbn} onChange={(e) => addForm.setData('isbn', e.target.value)} />
                                    </div>
                                    <div className="space-y-2">
                                        <Label htmlFor="quantity">Quantity</Label>
                                        <Input id="quantity" type="number" value={addForm.data.quantity} onChange={(e) => addForm.setData('quantity', e.target.value)} />
                                    </div>
                                    <div className="space-y-2">
                                        <Label htmlFor="category">Category</Label>
                                        <Input id="category" value={addForm.data.category} onChange={(e) => addForm.setData('category', e.target.value)} />
                                    </div>
                                    <Button type="submit" disabled={addForm.processing} className="w-full">Add Book</Button>
                                </form>
                            </DialogContent>
                        </Dialog>
                    </div>
                </div>

                <div className="grid gap-4 md:grid-cols-4">
                    {statCards.map((s, i) => (
                        <Card key={i}>
                            <CardContent className="p-4">
                                <p className="text-sm text-muted-foreground">{s.title}</p>
                                <p className="text-2xl font-bold">{s.value}</p>
                            </CardContent>
                        </Card>
                    ))}
                </div>

                <Card>
                    <CardHeader><CardTitle className="text-base">Books</CardTitle></CardHeader>
                    <CardContent>
                        <Table>
                            <TableHeader>
                                <TableRow>
                                    <TableHead>Title</TableHead>
                                    <TableHead>Author</TableHead>
                                    <TableHead>ISBN</TableHead>
                                    <TableHead>Category</TableHead>
                                    <TableHead>Quantity</TableHead>
                                    <TableHead>Available</TableHead>
                                </TableRow>
                            </TableHeader>
                            <TableBody>
                                {books?.map((book) => (
                                    <TableRow key={book.id}>
                                        <TableCell className="font-medium">{book.title}</TableCell>
                                        <TableCell>{book.author}</TableCell>
                                        <TableCell>{book.isbn}</TableCell>
                                        <TableCell>{book.category}</TableCell>
                                        <TableCell>{book.quantity}</TableCell>
                                        <TableCell>{book.available_count}</TableCell>
                                    </TableRow>
                                ))}
                                {(!books || books.length === 0) && (
                                    <TableRow><TableCell colSpan={6} className="text-center text-muted-foreground">No books yet.</TableCell></TableRow>
                                )}
                            </TableBody>
                        </Table>
                    </CardContent>
                </Card>
            </div>
        </AppLayout>
    );
}
