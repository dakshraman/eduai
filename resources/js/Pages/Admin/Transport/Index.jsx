import AppLayout from '@/layouts/AppLayout';
import { useForm, router } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import { Trash2 } from 'lucide-react';

export default function Index({ routes: routeList, vehicles }) {
    const routeForm = useForm({ name: '', fare: '' });
    const vehicleForm = useForm({ plate_number: '', type: 'bus', capacity: '', driver_name: '', route_id: '' });

    const handleRoute = (e) => {
        e.preventDefault();
        routeForm.post(route('admin.transport.routes.store'), { onSuccess: () => routeForm.reset() });
    };

    const handleVehicle = (e) => {
        e.preventDefault();
        vehicleForm.post(route('admin.transport.vehicles.store'), { onSuccess: () => vehicleForm.reset() });
    };

    const deleteRoute = (id) => {
        if (confirm('Delete this route?')) router.delete(route('admin.transport.routes.destroy', id));
    };

    const deleteVehicle = (id) => {
        if (confirm('Delete this vehicle?')) router.delete(route('admin.transport.vehicles.destroy', id));
    };

    return (
        <AppLayout title="Transport">
            <div className="space-y-6">
                <div>
                    <h1 className="text-2xl font-bold tracking-tight">Transport Management</h1>
                    <p className="text-muted-foreground">Manage routes and vehicles.</p>
                </div>

                {/* Routes Section */}
                <div className="grid gap-6 lg:grid-cols-3">
                    <Card className="lg:col-span-1">
                        <CardHeader><CardTitle className="text-base">Add Route</CardTitle></CardHeader>
                        <CardContent>
                            <form onSubmit={handleRoute} className="space-y-4">
                                <div className="space-y-2">
                                    <Label htmlFor="route_name">Route Name</Label>
                                    <Input id="route_name" value={routeForm.data.name} onChange={(e) => routeForm.setData('name', e.target.value)} placeholder="e.g. Route A" />
                                </div>
                                <div className="space-y-2">
                                    <Label htmlFor="fare">Fare</Label>
                                    <Input id="fare" type="number" value={routeForm.data.fare} onChange={(e) => routeForm.setData('fare', e.target.value)} />
                                </div>
                                <Button type="submit" disabled={routeForm.processing} className="w-full">Add Route</Button>
                            </form>
                        </CardContent>
                    </Card>

                    <Card className="lg:col-span-2">
                        <CardHeader><CardTitle className="text-base">Routes</CardTitle></CardHeader>
                        <CardContent>
                            <Table>
                                <TableHeader>
                                    <TableRow>
                                        <TableHead>Name</TableHead>
                                        <TableHead>Fare</TableHead>
                                        <TableHead>Vehicles</TableHead>
                                        <TableHead className="w-[60px]"></TableHead>
                                    </TableRow>
                                </TableHeader>
                                <TableBody>
                                    {routeList?.map((r) => (
                                        <TableRow key={r.id}>
                                            <TableCell className="font-medium">{r.name}</TableCell>
                                            <TableCell>{r.fare}</TableCell>
                                            <TableCell>{r.vehicles_count || r.vehicles?.length || 0}</TableCell>
                                            <TableCell>
                                                <Button variant="ghost" size="icon" onClick={() => deleteRoute(r.id)}>
                                                    <Trash2 className="h-4 w-4 text-destructive" />
                                                </Button>
                                            </TableCell>
                                        </TableRow>
                                    ))}
                                    {(!routeList || routeList.length === 0) && (
                                        <TableRow><TableCell colSpan={4} className="text-center text-muted-foreground">No routes yet.</TableCell></TableRow>
                                    )}
                                </TableBody>
                            </Table>
                        </CardContent>
                    </Card>
                </div>

                {/* Vehicles Section */}
                <div className="grid gap-6 lg:grid-cols-3">
                    <Card className="lg:col-span-1">
                        <CardHeader><CardTitle className="text-base">Add Vehicle</CardTitle></CardHeader>
                        <CardContent>
                            <form onSubmit={handleVehicle} className="space-y-4">
                                <div className="space-y-2">
                                    <Label htmlFor="plate_number">Plate Number</Label>
                                    <Input id="plate_number" value={vehicleForm.data.plate_number} onChange={(e) => vehicleForm.setData('plate_number', e.target.value)} />
                                </div>
                                <div className="space-y-2">
                                    <Label>Type</Label>
                                    <Select value={vehicleForm.data.type} onValueChange={(v) => vehicleForm.setData('type', v)}>
                                        <SelectTrigger><SelectValue /></SelectTrigger>
                                        <SelectContent>
                                            <SelectItem value="bus">Bus</SelectItem>
                                            <SelectItem value="van">Van</SelectItem>
                                            <SelectItem value="car">Car</SelectItem>
                                        </SelectContent>
                                    </Select>
                                </div>
                                <div className="space-y-2">
                                    <Label htmlFor="capacity">Capacity</Label>
                                    <Input id="capacity" type="number" value={vehicleForm.data.capacity} onChange={(e) => vehicleForm.setData('capacity', e.target.value)} />
                                </div>
                                <div className="space-y-2">
                                    <Label htmlFor="driver_name">Driver Name</Label>
                                    <Input id="driver_name" value={vehicleForm.data.driver_name} onChange={(e) => vehicleForm.setData('driver_name', e.target.value)} />
                                </div>
                                <div className="space-y-2">
                                    <Label>Route</Label>
                                    <Select value={vehicleForm.data.route_id} onValueChange={(v) => vehicleForm.setData('route_id', v)}>
                                        <SelectTrigger><SelectValue placeholder="Select route" /></SelectTrigger>
                                        <SelectContent>
                                            {routeList?.map((r) => (
                                                <SelectItem key={r.id} value={String(r.id)}>{r.name}</SelectItem>
                                            ))}
                                        </SelectContent>
                                    </Select>
                                </div>
                                <Button type="submit" disabled={vehicleForm.processing} className="w-full">Add Vehicle</Button>
                            </form>
                        </CardContent>
                    </Card>

                    <Card className="lg:col-span-2">
                        <CardHeader><CardTitle className="text-base">Vehicles</CardTitle></CardHeader>
                        <CardContent>
                            <Table>
                                <TableHeader>
                                    <TableRow>
                                        <TableHead>Plate</TableHead>
                                        <TableHead>Type</TableHead>
                                        <TableHead>Capacity</TableHead>
                                        <TableHead>Driver</TableHead>
                                        <TableHead>Route</TableHead>
                                        <TableHead className="w-[60px]"></TableHead>
                                    </TableRow>
                                </TableHeader>
                                <TableBody>
                                    {vehicles?.map((v) => (
                                        <TableRow key={v.id}>
                                            <TableCell className="font-medium">{v.plate_number}</TableCell>
                                            <TableCell className="capitalize">{v.type}</TableCell>
                                            <TableCell>{v.capacity}</TableCell>
                                            <TableCell>{v.driver_name}</TableCell>
                                            <TableCell>{v.route?.name}</TableCell>
                                            <TableCell>
                                                <Button variant="ghost" size="icon" onClick={() => deleteVehicle(v.id)}>
                                                    <Trash2 className="h-4 w-4 text-destructive" />
                                                </Button>
                                            </TableCell>
                                        </TableRow>
                                    ))}
                                    {(!vehicles || vehicles.length === 0) && (
                                        <TableRow><TableCell colSpan={6} className="text-center text-muted-foreground">No vehicles yet.</TableCell></TableRow>
                                    )}
                                </TableBody>
                            </Table>
                        </CardContent>
                    </Card>
                </div>
            </div>
        </AppLayout>
    );
}
