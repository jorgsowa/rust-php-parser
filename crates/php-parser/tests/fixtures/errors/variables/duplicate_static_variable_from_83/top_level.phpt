===source===
<?php
static $c; static $c;
===errors >=8.3===
Duplicate declaration of static variable $c
===php_error >=8.3===
PHP Fatal error:  Duplicate declaration of static variable $c in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "StaticVar": [
          {
            "name": {
              "name": "c",
              "span": {
                "start": 13,
                "end": 15
              }
            },
            "default": null,
            "span": {
              "start": 13,
              "end": 15
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 16
      }
    },
    {
      "kind": {
        "StaticVar": [
          {
            "name": {
              "name": "c",
              "span": {
                "start": 24,
                "end": 26
              }
            },
            "default": null,
            "span": {
              "start": 24,
              "end": 26
            }
          }
        ]
      },
      "span": {
        "start": 17,
        "end": 27
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 27
  }
}
