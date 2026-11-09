===source===
<?php
A::$"b";
===errors===
expected variable, found string
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '"b"' (T_CONSTANT_ENCAPSED_STRING), expecting variable (T_VARIABLE) or '{' or '$' in Standard input code on line 2
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected double-quoted string "b", expecting variable or "{" or "$" in Standard input code on line 2
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
                      "A"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 6,
                      "end": 7
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 7
                }
              },
              "member": {
                "kind": {
                  "VariableVariable": {
                    "kind": {
                      "String": "b"
                    },
                    "span": {
                      "start": 10,
                      "end": 13
                    }
                  }
                },
                "span": {
                  "start": 9,
                  "end": 13
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 13
          }
        }
      },
      "span": {
        "start": 6,
        "end": 14
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 14
  }
}
