===source===
<?php
static $top;
static $top;
===errors >=8.3===
Duplicate declaration of static variable $top
===php_error >=8.3===
PHP Fatal error:  Duplicate declaration of static variable $top in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "StaticVar": [
          {
            "name": {
              "name": "top",
              "span": {
                "start": 13,
                "end": 17
              }
            },
            "default": null,
            "span": {
              "start": 13,
              "end": 17
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 18
      }
    },
    {
      "kind": {
        "StaticVar": [
          {
            "name": {
              "name": "top",
              "span": {
                "start": 26,
                "end": 30
              }
            },
            "default": null,
            "span": {
              "start": 26,
              "end": 30
            }
          }
        ]
      },
      "span": {
        "start": 19,
        "end": 31
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 31
  }
}
