===source===
<?php declare(ticks=1) ?>
<?php declare(encoding='UTF-8');
===errors===
declare(encoding=...) ignored because Zend multibyte feature is turned off by settings
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
          "body": null
        }
      },
      "span": {
        "start": 6,
        "end": 22
      }
    },
    {
      "kind": {
        "InlineHtml": "\n"
      },
      "span": {
        "start": 25,
        "end": 26
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
                  "start": 49,
                  "end": 56
                }
              }
            ]
          ],
          "body": null
        }
      },
      "span": {
        "start": 32,
        "end": 58
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 58
  }
}
