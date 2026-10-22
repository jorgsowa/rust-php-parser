===source===
<?php foo(for: $x);
===errors <=7.4===
'named arguments' requires PHP 8.0 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'for' (T_FOR) in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Name": {
                    "parts": [
                      "foo"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 6,
                      "end": 9
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 9
                }
              },
              "args": [
                {
                  "name": {
                    "parts": [
                      "for"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 10,
                      "end": 13
                    }
                  },
                  "kind": {
                    "Value": {
                      "kind": {
                        "Variable": "x"
                      },
                      "span": {
                        "start": 15,
                        "end": 17
                      }
                    }
                  },
                  "span": {
                    "start": 10,
                    "end": 17
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 18
          }
        }
      },
      "span": {
        "start": 6,
        "end": 19
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 19
  }
}
