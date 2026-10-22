===source===
<?php
$r = match(true) {
    default => <<<'NOW'
    literal
    NOW,
};
===errors <=7.4===
'match expressions' requires PHP 8.0 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'default' (T_DEFAULT) in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "r"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Match": {
                    "subject": {
                      "kind": {
                        "Bool": true
                      },
                      "span": {
                        "start": 17,
                        "end": 21
                      }
                    },
                    "arms": [
                      {
                        "conditions": null,
                        "body": {
                          "kind": {
                            "Nowdoc": {
                              "label": "NOW",
                              "value": "literal"
                            }
                          },
                          "span": {
                            "start": 40,
                            "end": 68
                          }
                        },
                        "span": {
                          "start": 29,
                          "end": 68
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 11,
                  "end": 71
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 71
          }
        }
      },
      "span": {
        "start": 6,
        "end": 72
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 72
  }
}
