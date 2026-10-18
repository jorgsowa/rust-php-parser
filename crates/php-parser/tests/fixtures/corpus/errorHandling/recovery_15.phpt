===source===
<?php
Foo::$
===errors===
expected variable, found end of file
expected expression
expected ';' after expression
===php_error===
PHP Parse error:  syntax error, unexpected end of file, expecting variable or "{" or "$" in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticPropertyAccessDynamic": {
              "class": {
                "kind": {
                  "Name": {
                    "parts": [
                      "Foo"
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
              "member": {
                "kind": {
                  "VariableVariable": {
                    "kind": "Error",
                    "span": {
                      "start": 12,
                      "end": 12
                    }
                  }
                },
                "span": {
                  "start": 11,
                  "end": 12
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 12
          }
        }
      },
      "span": {
        "start": 6,
        "end": 12
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 12
  }
}
