===source===
<?php ; declare(ticks=1, encoding='UTF-8');
===errors===
Encoding declaration pragma must be the very first statement in the script
===php_error===
PHP Warning:  declare(encoding=...) ignored because Zend multibyte feature is turned off by settings in Standard input code on line 1
PHP Fatal error:  Encoding declaration pragma must be the very first statement in the script in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": "Nop",
      "span": {
        "start": 6,
        "end": 7
      }
    },
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
                  "start": 22,
                  "end": 23
                }
              }
            ],
            [
              "encoding",
              {
                "kind": {
                  "String": "UTF-8"
                },
                "span": {
                  "start": 34,
                  "end": 41
                }
              }
            ]
          ],
          "body": null
        }
      },
      "span": {
        "start": 8,
        "end": 43
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 43
  }
}
