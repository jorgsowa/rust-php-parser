===source===
<?php unset($a?->b);
===errors===
Can't use nullsafe operator in write context
===php_error===
PHP Fatal error:  Can't use nullsafe operator in write context in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Unset": [
          {
            "kind": {
              "NullsafePropertyAccess": {
                "object": {
                  "kind": {
                    "Variable": "a"
                  },
                  "span": {
                    "start": 12,
                    "end": 14
                  }
                },
                "property": {
                  "kind": {
                    "Identifier": "b"
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
