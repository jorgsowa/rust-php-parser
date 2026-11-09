===source===
<?php
unset(OBJ->a);
===errors <=7.4===
'object access on a constant' requires PHP 8.0 or higher
Cannot use temporary expression in write context
===errors 8.0-8.5===
Cannot use temporary expression in write context
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '->' (T_OBJECT_OPERATOR), expecting '[' in Standard input code on line 2
===php_error 8.0-8.5===
PHP Fatal error:  Cannot use temporary expression in write context in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Unset": [
          {
            "kind": {
              "PropertyAccess": {
                "object": {
                  "kind": {
                    "Name": {
                      "parts": [
                        "OBJ"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 12,
                        "end": 15
                      }
                    }
                  },
                  "span": {
                    "start": 12,
                    "end": 15
                  }
                },
                "property": {
                  "kind": {
                    "Identifier": "a"
                  },
                  "span": {
                    "start": 17,
                    "end": 18
                  }
                }
              }
            },
            "span": {
              "start": 12,
              "end": 18
            }
          }
        ]
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
