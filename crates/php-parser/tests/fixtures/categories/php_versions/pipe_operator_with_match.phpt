===source===
<?php $x |> match(true) { default => 'a' };
===errors <=7.4===
'pipe operator (|>)' requires PHP 8.5 or higher
'match expressions' requires PHP 8.0 or higher
===errors 8.0-8.4===
'pipe operator (|>)' requires PHP 8.5 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '>' in Standard input code on line 1
===php_error 8.0-8.4===
PHP Parse error:  syntax error, unexpected token ">" in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Binary": {
              "left": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Pipe",
              "right": {
                "kind": {
                  "Match": {
                    "subject": {
                      "kind": {
                        "Bool": true
                      },
                      "span": {
                        "start": 18,
                        "end": 22
                      }
                    },
                    "arms": [
                      {
                        "conditions": null,
                        "body": {
                          "kind": {
                            "String": "a"
                          },
                          "span": {
                            "start": 37,
                            "end": 40
                          }
                        },
                        "span": {
                          "start": 26,
                          "end": 40
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 12,
                  "end": 42
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 42
          }
        }
      },
      "span": {
        "start": 6,
        "end": 43
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 43
  }
}
