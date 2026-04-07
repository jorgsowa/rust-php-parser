===source===
<?php unset($a, $b);
===ast===
{
  "stmts": [
    {
      "kind": {
        "Unset": [
          {
            "kind": {
              "Variable": "a"
            },
            "span": {
              "start": 12,
              "end": 14
            }
          },
          {
            "kind": {
              "Variable": "b"
            },
            "span": {
              "start": 16,
              "end": 18
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 20
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 20
  }
}
