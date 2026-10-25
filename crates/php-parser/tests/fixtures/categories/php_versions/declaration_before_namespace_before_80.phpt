===source===
<?php
function f() {}
use B;
class C extends Exception {}
interface I {}
trait T {}
namespace A;
echo 1;
===errors >=8.0===
Namespace declaration statement has to be the very first statement or after any declare call in the script
===php_error >=8.0===
PHP Warning:  The use statement with non-compound name 'B' has no effect in Standard input code on line 3
PHP Fatal error:  Namespace declaration statement has to be the very first statement or after any declare call in the script in Standard input code on line 7
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 15,
              "end": 16
            }
          },
          "params": [],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 21
      }
    },
    {
      "kind": {
        "Use": {
          "kind": "Normal",
          "uses": [
            {
              "name": {
                "parts": [
                  "B"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 26,
                  "end": 27
                }
              },
              "alias": null,
              "span": {
                "start": 26,
                "end": 27
              }
            }
          ]
        }
      },
      "span": {
        "start": 22,
        "end": 28
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
            "span": {
              "start": 35,
              "end": 36
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": {
            "parts": [
              "Exception"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 45,
              "end": 54
            }
          },
          "implements": [],
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 29,
        "end": 57
      }
    },
    {
      "kind": {
        "Interface": {
          "name": {
            "name": "I",
            "span": {
              "start": 68,
              "end": 69
            }
          },
          "extends": [],
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 58,
        "end": 72
      }
    },
    {
      "kind": {
        "Trait": {
          "name": {
            "name": "T",
            "span": {
              "start": 79,
              "end": 80
            }
          },
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 73,
        "end": 83
      }
    },
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "A"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 94,
              "end": 95
            }
          },
          "body": "Simple"
        }
      },
      "span": {
        "start": 84,
        "end": 96
      }
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "Int": 1
            },
            "span": {
              "start": 102,
              "end": 103
            }
          }
        ]
      },
      "span": {
        "start": 97,
        "end": 104
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 104
  }
}
