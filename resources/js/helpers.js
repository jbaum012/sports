import { DateTime } from 'luxon';

/**
 * Groups the array {x} into arrays using the property {f}
 * https://stackoverflow.com/a/64489535/1396984
 */
export const groupBy = (x, f) => x.reduce((a, b) => ((a[f(b)] ||= []).push(b), a), {});

export const localize = (dateTime) => {
  let utcTime = DateTime.fromISO(dateTime, { zone: "UTC" }).toLocal()
  return utcTime
}
