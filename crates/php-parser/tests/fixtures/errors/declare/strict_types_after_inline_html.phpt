===source===
 <?php declare(strict_types=1);
===errors===
strict_types declaration must be the very first statement in the script
===php_error===
PHP Fatal error:  strict_types declaration must be the very first statement in the script in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "InlineHtml": " "
      },
      "span": {
        "start": 0,
        "end": 1
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
                  "start": 28,
                  "end": 29
                }
              }
            ]
          ],
          "body": null
        }
      },
      "span": {
        "start": 7,
        "end": 31
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 31
  }
}
