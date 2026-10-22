===source===
<?php clone(object: $x);
===errors <=7.4===
'named arguments' requires PHP 8.0 or higher
'clone function call' requires PHP 8.5 or higher
===errors 8.0-8.4===
'clone function call' requires PHP 8.5 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ':' in Standard input code on line 1
===php_error 8.0-8.4===
PHP Parse error:  syntax error, unexpected token ":" in Standard input code on line 1
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
                      "clone"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 6,
                      "end": 11
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 11
                }
              },
              "args": [
                {
                  "name": {
                    "parts": [
                      "object"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 12,
                      "end": 18
                    }
                  },
                  "kind": {
                    "Value": {
                      "kind": {
                        "Variable": "x"
                      },
                      "span": {
                        "start": 20,
                        "end": 22
                      }
                    }
                  },
                  "span": {
                    "start": 12,
                    "end": 22
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 23
          }
        }
      },
      "span": {
        "start": 6,
        "end": 24
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 24
  }
}
