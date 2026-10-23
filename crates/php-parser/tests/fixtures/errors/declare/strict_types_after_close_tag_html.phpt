===source===
<?php declare(strict_types=1); ?>x<?php declare(strict_types=1);
===errors===
strict_types declaration must be the very first statement in the script
===php_error===
PHP Fatal error:  strict_types declaration must be the very first statement in the script in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Declare": {
          "directives": [
            [
              "strict_types",
              {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 27,
                  "end": 28
                }
              }
            ]
          ],
          "body": null
        }
      },
      "span": {
        "start": 6,
        "end": 30
      }
    },
    {
      "kind": "Nop",
      "span": {
        "start": 31,
        "end": 33
      }
    },
    {
      "kind": {
        "InlineHtml": "x"
      },
      "span": {
        "start": 33,
        "end": 34
      }
    },
    {
      "kind": {
        "Declare": {
          "directives": [
            [
              "strict_types",
              {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 61,
                  "end": 62
                }
              }
            ]
          ],
          "body": null
        }
      },
      "span": {
        "start": 40,
        "end": 64
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 64
  }
}
