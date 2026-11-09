===source===
<?php
foreach ($a as $k => [$this]) {}
===errors===
Cannot re-assign $this
===php_error===
PHP Fatal error:  Cannot re-assign $this in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Foreach": {
          "expr": {
            "kind": {
              "Variable": "a"
            },
            "span": {
              "start": 15,
              "end": 17
            }
          },
          "key": {
            "kind": {
              "Variable": "k"
            },
            "span": {
              "start": 21,
              "end": 23
            }
          },
          "value": {
            "kind": {
              "Array": [
                {
                  "key": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "Variable": "this"
                      },
                      "span": {
                        "start": 28,
                        "end": 33
                      }
                    }
                  },
                  "span": {
                    "start": 28,
                    "end": 33
                  }
                }
              ]
            },
            "span": {
              "start": 27,
              "end": 34
            }
          },
          "body": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 36,
              "end": 38
            }
          }
        }
      },
      "span": {
        "start": 6,
        "end": 38
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 38
  }
}
