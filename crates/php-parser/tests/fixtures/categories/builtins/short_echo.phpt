===source===
<?= $value ?>
===ast===
{
  "stmts": [
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "Variable": "value"
            },
            "span": {
              "start": 4,
              "end": 10
            }
          }
        ]
      },
      "span": {
        "start": 4,
        "end": 11
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 11
  }
}
