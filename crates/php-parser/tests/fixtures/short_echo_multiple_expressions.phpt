===source===
<?= $a, $b, $c ?>
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
              "start": 4,
              "end": 6
            }
          },
          {
            "kind": {
              "Variable": "b"
            },
            "span": {
              "start": 8,
              "end": 10
            }
          },
          {
            "kind": {
              "Variable": "c"
            },
            "span": {
              "start": 12,
              "end": 14
            }
          }
        ]
      },
      "span": {
        "start": 4,
        "end": 14
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 14
  }
}
