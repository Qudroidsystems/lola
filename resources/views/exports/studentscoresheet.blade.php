<table>
    <thead>
        <tr>

                <th>SN</th>
                <th>ADMISSION NO</th>
                <th>NAME</th>
                <th>CA 1</th>
                <th>CA 2</th>
                <th>EXAM</th>
                <th>BROADSHEETID</th>
                <th>STAFFID</th>
                <th>SUBJECTCLASSID</th>
                <th>TERMID</th>
                <th>SESSION</th>


        </tr>
    </thead>
    <tbody>
        <?php $sn = 1; ?>
        @foreach ($broadsheets as $broadsheet)

        <tr>
            <td>{{ $sn++ }}</td>
            <td>{{ $broadsheet->admissionno }}</td>
            <td>{{ $broadsheet->fname }} {{ $broadsheet->lname }}</td>
            <td>{{ $broadsheet->ca1 }}</td>
            <td>{{ $broadsheet->ca2}}</td>
            <td>{{ $broadsheet->exam }}</td>
            <td>{{ $broadsheet->id}}</td>
            <td>{{ $broadsheet->staffid}}</td>
            <td>{{ $broadsheet->subjectclassid}}</td>
            <td>{{ $broadsheet->termid }}</td>
            <td>{{ $broadsheet->sessionid }}</td>
        </tr>
        @endforeach
     </tbody>
</table>
