===source===
<?php
echo \parent::$y;
===errors===
'\parent' is an invalid class name
===php_error===
PHP Fatal error:  '\parent' is an invalid class name in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "StaticPropertyAccess": {
                "class": {
                  "kind": {
                    "Name": {
                      "parts": [
                        "parent"
                      ],
                      "kind": "FullyQualified",
                      "span": {
                        "start": 11,
                        "end": 18
                      }
                    }
                  },
                  "span": {
                    "start": 11,
                    "end": 18
                  }
                },
                "member": {
                  "kind": {
                    "Identifier": "y"
                  },
                  "span": {
                    "start": 20,
                    "end": 22
                  }
                }
              }
            },
            "span": {
              "start": 11,
              "end": 22
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 23
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 23
  }
}
