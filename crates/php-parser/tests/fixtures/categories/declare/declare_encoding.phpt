===source===
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
              "encoding",
              {
                "kind": {
                  "String": "UTF-8"
                },
                "span": {
                  "start": 23,
                  "end": 30
                }
              }
            ]
          ],
          "body": null
        }
      },
      "span": {
        "start": 6,
        "end": 32
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 32
  }
}
