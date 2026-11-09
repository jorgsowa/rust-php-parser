===source===
<?php
echo "{$g{0}}";
===errors >=8.0===
Array and string offset access syntax with curly braces is no longer supported
===php_error 8.0-8.3===
PHP Fatal error:  Array and string offset access syntax with curly braces is no longer supported in Standard input code on line 2
===php_error >=8.4===
PHP Parse error:  syntax error, unexpected token "{", expecting "->" or "?->" or "[" in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "InterpolatedString": [
                {
                  "Expr": {
                    "kind": {
                      "ArrayAccess": {
                        "array": {
                          "kind": {
                            "Variable": "g"
                          },
                          "span": {
                            "start": 13,
                            "end": 15
                          }
                        },
                        "index": {
                          "kind": {
                            "Int": 0
                          },
                          "span": {
                            "start": 16,
                            "end": 17
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 13,
                      "end": 18
                    }
                  }
                }
              ]
            },
            "span": {
              "start": 11,
              "end": 20
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 21
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 21
  }
}
