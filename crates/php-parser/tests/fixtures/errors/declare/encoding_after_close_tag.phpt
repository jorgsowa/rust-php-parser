===source===
<?php declare(ticks=1) {} ?>
<?php declare(encoding='UTF-8');
===errors===
Encoding declaration pragma must be the very first statement in the script
===php_error===
PHP Warning:  declare(encoding=...) ignored because Zend multibyte feature is turned off by settings in Standard input code on line 2
PHP Fatal error:  Encoding declaration pragma must be the very first statement in the script in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Declare": {
          "directives": [
            [
              "ticks",
              {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 20,
                  "end": 21
                }
              }
            ]
          ],
          "body": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 23,
              "end": 25
            }
          }
        }
      },
      "span": {
        "start": 6,
        "end": 25
      }
    },
    {
      "kind": "Nop",
      "span": {
        "start": 26,
        "end": 29
      }
    },
    {
      "kind": {
        "Declare": {
          "directives": [
            [
              "encoding",
              {
                "kind": {
                  "String": "UTF-8"
                },
                "span": {
                  "start": 52,
                  "end": 59
                }
              }
            ]
          ],
          "body": null
        }
      },
      "span": {
        "start": 35,
        "end": 61
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 61
  }
}
