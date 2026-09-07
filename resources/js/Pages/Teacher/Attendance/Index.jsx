import AppLayout from '@/layouts/AppLayout';
import { useForm, router } from '@inertiajs/react';
import { useState } from 'react';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import { RadioGroup, RadioGroupItem } from '@/components/ui/radio-group';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import { Save } from 'lucide-react';

const STATUSES = [
    { value: 'present', label: 'Present', color: 'bg-emerald-100 text-emerald-700' },
    { value: 'absent', label: 'Absent', color: 'bg-red-100 text-red-700' },
    { value: 'late', label: 'Late', color: 'bg-amber-100 text-amber-700' },
    { value: 'half_day', label: 'Half Day', color: 'bg-blue-100 text-blue-700' },
];

export default function Index({ classes, students, classId, date, attendanceData }) {
    const { data, setData, post, processing } = useForm({
        class_id: classId || '',
        date: date || new Date().toISOString().split('T')[0],
        attendance: attendanceData || {},
    });

    const [selectedClass, setSelectedClass] = useState(classId || '');
    const [selectedDate, setSelectedDate] = useState(date || new Date().toISOString().split('T')[0]);

    const loadStudents = () => {
        router.get('/teacher/attendance', { class_id: selectedClass, date: selectedDate }, { preserveState: true });
    };

    const setAttendance = (studentId, status) => {
        setData('attendance', { ...data.attendance, [studentId]: status });
    };

    const submit = (e) => {
        e.preventDefault();
        post('/teacher/attendance');
    };

    return (
        <AppLayout title="Attendance">
            <div className="space-y-6">
                <div>
                    <h1 className="text-2xl font-bold tracking-tight">Mark Attendance</h1>
                    <p className="text-muted-foreground">Select a class and date, then mark each student</p>
                </div>

                {/* Filter Form */}
                <Card>
                    <CardContent className="p-4">
                        <div className="flex items-end gap-4">
                            <div className="flex-1">
                                <Label className="mb-1 block text-sm">Class</Label>
                                <Select value={selectedClass} onValueChange={setSelectedClass}>
                                    <SelectTrigger><SelectValue placeholder="Select class" /></SelectTrigger>
                                    <SelectContent>
                                        {classes?.map((c) => <SelectItem key={c.id} value={String(c.id)}>{c.name}</SelectItem>)}
                                    </SelectContent>
                                </Select>
                            </div>
                            <div className="flex-1">
                                <Label className="mb-1 block text-sm">Date</Label>
                                <Input type="date" value={selectedDate} onChange={(e) => setSelectedDate(e.target.value)} />
                            </div>
                            <Button onClick={loadStudents} disabled={!selectedClass}>Load Students</Button>
                        </div>
                    </CardContent>
                </Card>

                {/* Student Attendance List */}
                {students?.length > 0 && (
                    <form onSubmit={submit}>
                        <Card>
                            <CardHeader className="flex flex-row items-center justify-between">
                                <CardTitle className="text-base">Students</CardTitle>
                                <Button type="submit" disabled={processing} className="gap-2">
                                    <Save className="h-4 w-4" /> Save Attendance
                                </Button>
                            </CardHeader>
                            <CardContent>
                                <Table>
                                    <TableHeader>
                                        <TableRow>
                                            <TableHead>#</TableHead>
                                            <TableHead>Name</TableHead>
                                            <TableHead>Section</TableHead>
                                            <TableHead className="text-center">Status</TableHead>
                                        </TableRow>
                                    </TableHeader>
                                    <TableBody>
                                        {students.map((student, idx) => (
                                            <TableRow key={student.id}>
                                                <TableCell className="text-muted-foreground">{idx + 1}</TableCell>
                                                <TableCell className="font-medium">{student.user?.name}</TableCell>
                                                <TableCell>{student.section?.name || '-'}</TableCell>
                                                <TableCell>
                                                    <RadioGroup
                                                        value={data.attendance[student.id]?.status || ''}
                                                        onValueChange={(val) => setAttendance(student.id, val)}
                                                        className="flex items-center justify-center gap-2"
                                                    >
                                                        {STATUSES.map((s) => (
                                                            <label key={s.value} className={`flex items-center gap-1 px-3 py-1 rounded-full text-xs font-medium cursor-pointer transition-colors ${data.attendance[student.id]?.status === s.value ? s.color : 'bg-muted text-muted-foreground'}`}>
                                                                <RadioGroupItem value={s.value} className="sr-only" />
                                                                {s.label}
                                                            </label>
                                                        ))}
                                                    </RadioGroup>
                                                </TableCell>
                                            </TableRow>
                                        ))}
                                    </TableBody>
                                </Table>
                            </CardContent>
                        </Card>
                    </form>
                )}

                {students !== undefined && students.length === 0 && (
                    <Card>
                        <CardContent className="py-8 text-center text-muted-foreground">
                            No students found for this class. Select a class and click "Load Students".
                        </CardContent>
                    </Card>
                )}
            </div>
        </AppLayout>
    );
}