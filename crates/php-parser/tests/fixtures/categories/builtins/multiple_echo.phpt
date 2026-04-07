===source===
<?php echo $a, $b, $c;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "Variable": "a"
            },
            "span": {
              "start": 11,
              "end": 13
            }
          },
          {
            "kind": {
              "Variable": "b"
            },
            "span": {
              "start": 15,
              "end": 17
            }
          },
          {
            "kind": {
              "Variable": "c"
            },
            "span": {
              "start": 19,
              "end": 21
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 22
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 22
  }
}
