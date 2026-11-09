===source===
<?php
clone(...)->b;
===errors <=8.0===
'first-class callable syntax' requires PHP 8.1 or higher
'clone(...) first-class callable' requires PHP 8.5 or higher
Cannot dereference this expression
===errors 8.1-8.4===
'clone(...) first-class callable' requires PHP 8.5 or higher
Cannot dereference this expression
===errors >=8.5===
Cannot dereference this expression
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '...' (T_ELLIPSIS) in Standard input code on line 2
===php_error 8.0-8.4===
PHP Parse error:  syntax error, unexpected token "..." in Standard input code on line 2
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
                  "CallableCreate": {
                    "kind": {
                      "Function": {
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
                      }
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 16
                }
              },
              "property": {
                "kind": {
                  "Identifier": "b"
                },
                "span": {
                  "start": 18,
                  "end": 19
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 19
          }
        }
      },
      "span": {
        "start": 6,
        "end": 20
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 20
  }
}
