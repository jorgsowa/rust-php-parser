===source===
<?php
echo \self::X;
===errors===
'\self' is an invalid class name
===php_error===
PHP Fatal error:  '\self' is an invalid class name in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "ClassConstAccess": {
                "class": {
                  "kind": {
                    "Name": {
                      "parts": [
                        "self"
                      ],
                      "kind": "FullyQualified",
                      "span": {
                        "start": 11,
                        "end": 16
                      }
                    }
                  },
                  "span": {
                    "start": 11,
                    "end": 16
                  }
                },
                "member": {
                  "kind": {
                    "Identifier": "X"
                  },
                  "span": {
                    "start": 18,
                    "end": 19
                  }
                }
              }
            },
            "span": {
              "start": 11,
              "end": 19
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
