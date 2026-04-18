===config===
parse_version=8.5
min_php=8.5
===source===
<?php (void)(void)$x;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Cast": [
              "Void",
              {
                "kind": {
                  "Cast": [
                    "Void",
                    {
                      "kind": {
                        "Variable": "x"
                      },
                      "span": {
                        "start": 18,
                        "end": 20
                      }
                    }
                  ]
                },
                "span": {
                  "start": 12,
                  "end": 20
                }
              }
            ]
          },
          "span": {
            "start": 6,
            "end": 20
          }
        }
      },
      "span": {
        "start": 6,
        "end": 21
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 21
  }
}
