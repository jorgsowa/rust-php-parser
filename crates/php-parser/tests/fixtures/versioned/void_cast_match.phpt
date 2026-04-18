===config===
min_php=8.5
===source===
<?php (void)match($x) { default => 1 };
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
                  "Match": {
                    "subject": {
                      "kind": {
                        "Variable": "x"
                      },
                      "span": {
                        "start": 18,
                        "end": 20
                      }
                    },
                    "arms": [
                      {
                        "conditions": null,
                        "body": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 35,
                            "end": 36
                          }
                        },
                        "span": {
                          "start": 24,
                          "end": 36
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 12,
                  "end": 38
                }
              }
            ]
          },
          "span": {
            "start": 6,
            "end": 38
          }
        }
      },
      "span": {
        "start": 6,
        "end": 39
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 39
  }
}
