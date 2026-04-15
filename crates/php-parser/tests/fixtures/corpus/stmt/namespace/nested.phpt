===config===
php_rejects=semantic
===source===
<?php
namespace A {
    namespace B {

    }
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "A"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 16,
              "end": 17
            }
          },
          "body": {
            "Braced": [
              {
                "kind": {
                  "Namespace": {
                    "name": {
                      "parts": [
                        "B"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 34,
                        "end": 35
                      }
                    },
                    "body": {
                      "Braced": []
                    }
                  }
                },
                "span": {
                  "start": 24,
                  "end": 44
                }
              }
            ]
          }
        }
      },
      "span": {
        "start": 6,
        "end": 46
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 46
  }
}
===php_error===
PHP Fatal error:  Namespace declarations cannot be nested in Standard input code on line 3
Stack trace:
#0 {main}
