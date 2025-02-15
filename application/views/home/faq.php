<div class="faq-container container mt-5">
    <h1 class="text-center">Frequently Asked Questions</h1>
    <h2 class="mt-4">How to use the Primordis.tech Tool</h2>

    <section>
        <h3>General Information</h3>
        <h4>1. What type of file can I upload for analysis?</h4>
        <p>You can upload files in the following formats:</p>
        <ul>
            <li><strong>.csv</strong>: Comma-separated values file.</li>
            <li><strong>.xlsx</strong>: Excel file.</li>
        </ul>
        <p>Ensure that your file includes "Cycle" and "Discharge Capacity (Ah)" columns, as these are required for accurate processing and predictions.</p>
    </section>

    <section>
        <h4>2. How do I specify the discharge C-rate for my analysis?</h4>
        <p>C-rate measures how quickly a battery is charged or discharged relative to its maximum capacity.</p>
        <p>A 1C rate means full charge/discharge in one hour, 2C in 30 minutes, and so on.</p>
        <p>You can provide the C-rate during the upload process. If not specified, it defaults to 1.0.</p>
    </section>

    <section>
        <h4>3. What is the "End of Life" (EOL) prediction?</h4>
        <p>The EOL prediction estimates when the battery will degrade to 80% of its nominal capacity. The default threshold is 80%.</p>
    </section>

    <section>
        <h4>4. How do I upload my data?</h4>
        <ol>
            <li>Click on the <strong>Upload File</strong> button.</li>
            <li>Choose your file and enter required parameters.</li>
            <li>Click <strong>Submit</strong> to process your data.</li>
        </ol>
    </section>

    <section>
        <h4>5. What information do I need to provide during data upload?</h4>
        <ul>
            <li><strong>Test Name</strong>: Default is "tester".</li>
            <li><strong>Window Size</strong>: Default is 4.</li>
            <li><strong>Nominal Capacity</strong>: Default is 1.0 Ah.</li>
            <li><strong>C-rate</strong>: Default is 1.0.</li>
            <li><strong>End of Life SOH</strong>: Default is 80%.</li>
            <li><strong>Chemistry</strong>: Default is "LFP".</li>
            <li><strong>Current State of Health</strong>: Percentage of original capacity.</li>
        </ul>
    </section>

    <section>
        <h4>6. How are predictions made?</h4>
        <ul>
            <li>Machine learning predicts capacity degradation.</li>
            <li>Outputs include mean predictions and 95% confidence intervals.</li>
            <li>Results are visualized in a plot.</li>
        </ul>
    </section>

    <section>
        <h4>7. What do the results look like?</h4>
        <ul>
            <li>A plot of degradation predictions.</li>
            <li>Detailed reports on battery degradation and remaining useful life.</li>
        </ul>
    </section>

    <section>
        <h4>8. Can I view or download the results?</h4>
        <p>Yes, you can download:</p>
        <ul>
            <li>Prediction Plot (PNG)</li>
            <li>Excel Report</li>
        </ul>
    </section>

    <section>
        <h4>9. How long does it take to get the results?</h4>
        <p>Processing time varies but typically takes a few minutes.</p>
    </section>

    <section>
        <h4>10. How do I download the results?</h4>
        <p>After processing, use the provided links:</p>
        <ul>
            <li><strong>Plot</strong>: Download the prediction plot.</li>
            <li><strong>Report</strong>: Download the Excel report.</li>
        </ul>
    </section>

    <section>
        <h4>11. Who can I contact if I have further questions?</h4>
        <p>Email us at <a href="mailto:support@example.com">support@example.com</a> for any inquiries.</p>
    </section>
</div>
