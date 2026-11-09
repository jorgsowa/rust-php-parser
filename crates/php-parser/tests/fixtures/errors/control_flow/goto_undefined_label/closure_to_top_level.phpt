===source===
<?php
outer:
$f = function () {
    goto outer;
};
===errors===
'goto' to undefined label 'outer'
===php_error===
PHP Fatal error:  'goto' to undefined label 'outer' in Standard input code on line 4
===ast===
{
  "stmts": [
    {
      "kind": {
        "Label": {
          "name": "outer",
          "span": {
            "start": 6,
            "end": 11
          }
        }
      },
      "span": {
        "start": 6,
        "end": 12
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "f"
                },
                "span": {
                  "start": 13,
                  "end": 15
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Closure": {
                    "is_static": false,
                    "by_ref": false,
                    "params": [],
                    "use_vars": [],
                    "return_type": null,
                    "body": [
                      {
                        "kind": {
                          "Goto": {
                            "name": "outer",
                            "span": {
                              "start": 41,
                              "end": 46
                            }
                          }
                        },
                        "span": {
                          "start": 36,
                          "end": 47
                        }
                      }
                    ],
                    "attributes": []
                  }
                },
                "span": {
                  "start": 18,
                  "end": 49
                }
              }
            }
          },
          "span": {
            "start": 13,
            "end": 49
          }
        }
      },
      "span": {
        "start": 13,
        "end": 50
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 50
  }
}
