===source===
<?php
clone()->b;
===errors <=8.4===
'clone function call' requires PHP 8.5 or higher
Cannot dereference this expression
===errors >=8.5===
Cannot dereference this expression
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ')' in Standard input code on line 2
===php_error 8.0-8.4===
PHP Parse error:  syntax error, unexpected token ")" in Standard input code on line 2
===php_error >=8.5===
PHP Parse error:  syntax error, unexpected token "->" in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "PropertyAccess": {
              "object": {
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
                    "args": []
                  }
                },
                "span": {
                  "start": 6,
                  "end": 13
                }
              },
              "property": {
                "kind": {
                  "Identifier": "b"
                },
                "span": {
                  "start": 15,
                  "end": 16
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 16
          }
        }
      },
      "span": {
        "start": 6,
        "end": 17
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 17
  }
}
